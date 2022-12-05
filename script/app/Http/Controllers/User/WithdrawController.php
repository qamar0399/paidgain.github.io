<?php

namespace App\Http\Controllers\User;

use App\Models\Withdraw;
use App\Mail\WithdrawMail;
use Illuminate\Http\Request;
use App\Models\WithdrawMethod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class WithdrawController extends Controller
{
    public function index()
    {
        $withdraws = Withdraw::where('user_id', auth()->id())->with('method')->latest()->paginate(20);
        return view('user.withdraws.index', compact('withdraws'));
    }

    public function create(Request $request)
    {
        if (request()->ajax()) {
            $method = WithdrawMethod::where('id', $request->get('method'))->where('status', 1)->firstOrFail();
            $conversation = number_format(getcurrencyrate($method->rate), 2);

            // Get wallet amount
            if (defaultcurrency('currency') == $method->currency){
                $wallet = number_format(auth()->user()->balance, 2) .' '. defaultcurrency('currency');
            }else{
                $wallet = number_format(auth()->user()->balance, 2) .' '. defaultcurrency('currency') . ' = ' . number_format(($method->rate * auth()->user()->balance), 2) .' ' . $method->currency;
            }

            return response()->json([
                'method' => $method,
                'conversation' => $conversation,
                'wallet' => $wallet
            ]);
        }
        $methods = WithdrawMethod::latest()->where('status', 1)->get();
        return view('user.withdraws.create', compact('methods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'withdraw_method_id' => 'required|integer',
            'amount' => 'required|numeric',
            'commants' => 'required',
        ]);

        \DB::beginTransaction();
        try {
            $method = WithdrawMethod::find($request->withdraw_method_id);
            if ($method) {
                $mainBalance = auth()->user()->balance;
                $originalAmount = $request->input('amount');
                $convertedAmount = $originalAmount / $method->rate;

                if ($mainBalance >= $convertedAmount) {
                    if ($method->min_limit <= $originalAmount) {
                        if ($method->max_limit >= $originalAmount) {

                            if ($method->percent_charge > 0) {
                                $percent = $originalAmount / 100;
                                $charge = $percent * $method->percent_charge;
                            } else {
                                $charge = $method->fixed_charge;
                            }


                            $withdraw = Withdraw::create([
                                'charge' => $charge ?? 0,
                                'rate' => $method->rate,
                                'user_id' => auth()->id(),
                                'amount' => $originalAmount,
                                'commant' => $request->input('commant'),
                                'currency' => $method->currency,
                                'withdraw_method_id' => $request->input('withdraw_method_id'),
                            ]);

                            auth()->user()->update([
                                'balance' => $mainBalance - $convertedAmount
                            ]);

                            //Send Email to admin
                            if (env('QUEUE_MAIL')) {
                                Mail::to(env('MAIL_TO_ADDRESS'))->queue(new WithdrawMail($withdraw));
                            } else {
                                Mail::to(env('MAIL_TO_ADDRESS'))->send(new WithdrawMail($withdraw));
                            }

                            \DB::commit();

                            return response()->json("Success!, Please wait for confirmation.");
                        } else {
                            return response()->json('Maximum transaction amount '.$method->max_limit, 404);
                        }
                    } else {
                        return response()->json('Minimum transaction amount '.$method->min_limit, 404);
                    }
                } else {
                    return response()->json('Insufficient Balance. Your balance is '. currency_format((auth()->user()->balance ?? 0)), 404);
                }
            } else {
                return response()->json('Method not found.', 404);
            }
        }catch (\Throwable $e){
            \DB::rollBack();
            return response()->json(__('Oops! Something went wrong.'), 500);
        }


    }

    public function update(Request $request, $id)
    {
        //
    }
}
