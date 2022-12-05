<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;

class WithdrawalMethodController extends Controller
{
    public function index()
    {
        $methods = WithdrawMethod::paginate(20);
        return view('user.withdraws.methods.index', compact('methods'));
    }
}
