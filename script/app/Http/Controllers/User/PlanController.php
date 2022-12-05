<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = remember_cache('user.plans', function (){
            return Plan::whereStatus(1)->get();
        });

        return view('user.plans.index', compact('plans'));
    }
}
