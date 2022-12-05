<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Getway;
use App\Models\Deposit;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Throwable;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::where('user_id', auth()->id())->with('getway')->latest()->paginate(10);
        $total_deposit = Deposit::where([['user_id', auth()->id()], ['status', 1]])->sum('amount');
        $total_pending_deposit = Deposit::where([['user_id', auth()->id()], ['status', 2]])->sum('amount');
        return view('user.deposit.index', compact('deposits', 'total_deposit', 'total_pending_deposit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        Session::put('depositable_amount', $request->input('amount'));

    
        return redirect()->route('user.deposit.create');
    }

    public function payment(Request $request, $id)
    {
        $amount = session('depositable_amount');
        $gateway = Getway::where('status', 1)->findOrFail($id);
        $gateway_info = json_decode($gateway->data); //for creds
        if ($gateway->min_amount > $amount) {
            $err = __('The deposit amount cannot be less than :min_amount', ['min_amount' => $gateway->min_amount]);
            session()->flash('message', $err);
            return back();
        }

        if ($gateway->max_amount < $amount) {
            $err = __('The deposit amount cannot be greater than :max_amount', ['max_amount' => $gateway->max_amount]);
            session()->flash('message', $err);
            return back();
        }

        if ($gateway->is_auto == 0) {
            $request->validate([
                'screenshot' => 'required|image|max:800',
                'comment' => 'max:100',
            ]);
            $payment_data['comment'] = $request->comment;
            if ($request->hasFile('screenshot')) {

                $path = 'uploads/' . strtolower(env('APP_NAME')) . '/payments' . date('/y/m/');
                $name = uniqid() . date('dmy') . time() . "." . strtolower($request->screenshot->getClientOriginalExtension());

                Storage::put($path . $name, file_get_contents(Request()->file('screenshot')));

                $image = Storage::url($path . $name);

                $payment_data['screenshot'] = $image;
            }
        }

        $payment_data['currency'] = $gateway->currency_name ?? 'USD';
        $payment_data['email'] = auth()->user()->email;
        $payment_data['name'] = auth()->user()->name;
        $payment_data['phone'] = $request->phone;
        $payment_data['billName'] = __('Make Deposit');
        $payment_data['amount'] = $amount;
        $payment_data['test_mode'] = $gateway->test_mode;
        $payment_data['charge'] = $gateway->charge ?? 0;
        $payment_data['pay_amount'] = (round($amount, 2) * $gateway->rate) + $gateway->charge;
        $payment_data['getway_id'] = $gateway->id;
        $payment_data['payment_type'] = 'deposit';
        $payment_data['request_from'] = 'merchant';

        if (!empty($gateway_info)) {
            foreach ($gateway_info as $key => $info) {
                $payment_data[$key] = $info;
            }
        }

        session('payment_type', 'deposit');

        return $gateway->namespace::make_payment($payment_data);
    }

    public function failed()
    {
        session()->flash('message', __('Transaction Error Occurred!'));
        session()->forget('payment_info');
        session()->forget('payment_type');

        return redirect()->route('user.deposit.create');
    }

    public function success()
    {
        if (!session()->has('payment_info') && !session()->has('payment_type')) {
            abort(404);
        }

        $amount = session('depositable_amount');
        $getway_id = session('payment_info')['getway_id'];
        $gateway = Getway::findOrFail($getway_id);
        $trx = session('payment_info')['payment_id'];
        $payment_status = session('payment_info')['payment_status'] ?? 0;
        $status = session('payment_info')['status'] ?? 1;

        $totak_paid = (round($amount, 2) * $gateway->rate) + $gateway->charge;
        // Insert transaction data into deposit table

        DB::beginTransaction();
        try {

            $deposit = new Deposit();
            $deposit->user_id = auth()->id();
            $deposit->getway_id = $gateway->id;
            $deposit->trx = $trx;
            $deposit->totalamount = $totak_paid;
            $deposit->amount = $amount;
            $deposit->currency = $gateway->currency_name;
            $deposit->status = $status;
            $deposit->payment_status = $payment_status;
            $deposit->charge = $gateway->charge;
            $deposit->rate = $gateway->rate;
            $deposit->save();

            //depositmeta
            if ($gateway->is_auto == 0) {
                $data = session('payment_info')['meta'] ?? '';

                $deposit->depositmeta()->create([
                    'key' => 'depositinfo',
                    'value' => json_encode($data),
                ]);
            }

            if ($payment_status == 1 && $gateway->is_auto == 1) {
                $user = auth()->user();
                $user->balance = $user->balance + $amount;
                $user->save();
            }

            if (auth()->user()->user_id != null && $payment_status == 1 && $gateway->is_auto == 1) {
                $bonus = Category::where('type', 'ReferralCommissionConfig')->where('name', 'deposit')->where('status', 1)->first();
                if ($bonus != null) {
                    $ref_user = User::where('will_expire', '>=', now())->find(auth()->user()->user_id);
                    if (!empty($ref_user)) {
                        if (!empty($ref_user->plan_data)) {
                            $plan_data = json_decode($ref_user->plan_data);
                            $commision_rate = $plan_data->commission ?? 0;
                            $commission = ($amount / 100) * $commision_rate;

                            $ref_user->balance = $ref_user->balance + $commission;
                            $ref_user->save();

                            $ref = new Referral();
                            $ref->user_id = auth()->id();
                            $ref->ref_id = $ref_user->id;
                            $ref->amount = $commission;
                            $ref->type = 'deposit';
                            $ref->save();
                        }
                    }
                }
            }

            DB::commit();

            $status = session('payment_info')['payment_status'];

            session('deposit_status', $status);
            session()->flash('message', 'Transaction Successfully Complete!');

            if ($status != 0) {
                return redirect()->route('user.deposit.index');
            } else {
                return redirect('/user/deposit/create');
            }

        } catch (Throwable $th) {
            DB::rollback();
            return $th;
            session()->forget('payment_info');
            session()->flash('message', 'Something wrong please contact with support..!');
            session()->flash('type', 'error');
            return redirect()->route('user.deposit.index');
        }
    }

    public function create()
    {
        $gateways = Getway::where('status', 1)->latest()->get();
        $amount = session('depositable_amount');
        return view('user.deposit.create', compact('gateways', 'amount'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

}
