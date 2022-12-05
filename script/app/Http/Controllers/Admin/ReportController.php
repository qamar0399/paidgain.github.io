<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:report.list')->only('transaction', 'loginHistory', 'emailHistory', 'ptcview');
    }

    public function transaction(Request $request)
    {
        $transactions = Transaction::when($request->get('src'), function($query) use ($request){

            })
            ->latest()
            ->paginate();

        return view('admin.report.transaction', compact('transactions'));
    }

    public function loginHistory()
    {
        return view('admin.report.loginhistory');
    }

    public function subscriptions()
    {
        $subscriptions = Subscription::when(request('src'), function ($query){
            $query->whereHas('user', function ($query){
                $query->where('username', 'like', '%'.request('src').'%');
            });
        })
            ->latest()
            ->paginate();

        return view('admin.report.subscriptions', compact('subscriptions'));
    }

    public function referrals()
    {
        $referrals = Referral::when(request('src'), function ($query){
            $query->whereHas('user', function ($query){
                $query->where('username', 'like', '%'.request('src').'%');
            });
        })
            ->latest()
            ->paginate();

        return view('admin.report.referrals', compact('referrals'));
    }
}