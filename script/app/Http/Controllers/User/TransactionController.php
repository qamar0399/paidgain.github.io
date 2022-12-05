<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Auth;
class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::latest()->where('user_id',Auth::id())->paginate();
        return view('user.transactions.index', compact('transactions'));
    }
}
