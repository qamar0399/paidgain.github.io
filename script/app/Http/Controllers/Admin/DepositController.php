<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:deposit.list')->only('all', 'approved', 'detail', 'pending', 'rejected', 'successful');
    }

    public function pending(Request $request)
    {
        $pending = $this->getDeposits($request,2)->count();
        $approved = $this->getDeposits($request,1)->count();
        $reject = $this->getDeposits($request,3)->count();
        $failed = $this->getDeposits($request,0)->count();
        $all = $this->getDeposits($request)->count();

        $title = __('Pending Deposits');
        $deposits = $this->getDeposits($request, 2);

        return view('admin.deposits.log', compact('title', 'deposits','all','pending','approved','reject','failed'));
    }

    public function approved(Request $request)
    {

        $pending = $this->getDeposits($request,2)->count();
        $approved = $this->getDeposits($request,1)->count();
        $reject = $this->getDeposits($request,3)->count();
        $failed = $this->getDeposits($request,0)->count();
        $all = $this->getDeposits($request)->count();

        $title = __('Approved Deposits');
        $deposits = $this->getDeposits($request, 1);

        return view('admin.deposits.log', compact('title', 'deposits','all','pending','approved','reject','failed'));
    }

    public function successful(Request $request)
    {

        $pending = $this->getDeposits($request,2)->count();
        $approved = $this->getDeposits($request,1)->count();
        $reject = $this->getDeposits($request,3)->count();
        $failed = $this->getDeposits($request,0)->count();
        $all = $this->getDeposits($request)->count();

        $title = __('Successful Deposits');
        $deposits = $this->getDeposits($request, 1);

        return view('admin.deposits.log', compact('title', 'deposits','all','pending','approved','reject','failed'));
    }

    public function rejected(Request $request)
    {
        $pending = $this->getDeposits($request,2)->count();
        $approved = $this->getDeposits($request,1)->count();
        $reject = $this->getDeposits($request,3)->count();
        $failed = $this->getDeposits($request,0)->count();
        $all = $this->getDeposits($request)->count();

        $title = __('Rejected Deposits');
        $deposits = $this->getDeposits($request, 3);

        return view('admin.deposits.log', compact('title', 'deposits','all','pending','approved','reject','failed'));
    }

    public function all(Request $request)
    {

        $title = __('All Deposits');

        $pending = $this->getDeposits($request,2)->count();
        $approved = $this->getDeposits($request,1)->count();
        $reject = $this->getDeposits($request,3)->count();
        $failed = $this->getDeposits($request,0)->count();
        $all = $this->getDeposits($request)->count();

        $deposits = $this->getDeposits($request);

        return view('admin.deposits.log', compact('title', 'deposits','all','pending','approved','reject','failed'));
    }

    public function detail(Deposit $deposit)
    {
        return view('admin.deposits.detail', compact('deposit'));
    }

    public function update(Request $request, $id)
    {

       $deposit=Deposit::findorFail($id);
       $deposit->status=$request->status;
       $deposit->payment_status=$request->payment_status;
       $deposit->save();

       if ($request->balance == '1' || $request->balance == 1) {
           $user=User::findorFail($deposit->user_id);
           $user->balance = $user->balance + $deposit->amount;
           $user->save();
       }

       return response()->json(__('Deposit status updated...!!!'));
    }

    private function getDeposits($request, int $status = null){
        return Deposit::query()
            ->with('user')
            ->when($status, function ($query) use ($status){
                $query->where('status', '=', $status);
            })
            ->when($request->get('src'), function($query) use ($request){
                $query->where('trx', 'LIKE', '%'.$request->get('src').'%')
                    ->orWhereHas('user', function ($query) use ($request){
                        $query->where('username', 'LIKE', '%'. $request->get('src'). '%');
                    });
            })
            ->latest()
            ->paginate();
    }
}
