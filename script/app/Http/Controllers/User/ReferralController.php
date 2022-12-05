<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index()
    {
        $referrals = Referral::latest()->with('referredBy')->where('ref_id', auth()->id())->paginate(20);
        return view('user.refarrals.index', compact('referrals'));
    }
}
