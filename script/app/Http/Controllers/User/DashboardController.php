<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\PTCUser;
use App\Models\Transaction;
use App\Models\Withdraw;
use Auth;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        $total_deposit = Deposit::where('user_id', Auth::id())->where('status',1)->sum('amount');
        $transactions = Transaction::where('user_id', Auth::id())->latest()->paginate(20);
        $withdrawals = Withdraw::where('user_id', Auth::id())->get();

        $total_withdraw = 0;
        foreach ($withdrawals as $withdraw) {
            $total_withdraw += $withdraw->amount / $withdraw->rate;
        }

        $ptc_user = PTCUser::where('user_id',auth()->id())
            ->selectRaw('sum(earning) total_earning, count(id) as total_click')
            ->get();

        $today_clicks = PTCUser::whereDay('created_at', today()->format('d'))->count();
        $remain_clicks = (json_decode(auth()->user()->plan_data)->ad_limit ?? 0) - $today_clicks;

        return view('user.dashboard', compact('total_deposit', 'total_withdraw', 'transactions', 'ptc_user', 'today_clicks', 'remain_clicks'));
    }
}
