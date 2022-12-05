<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Artisan;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function clearCache(){
        Artisan::call('cache:clear');
        return redirect()->back()->with('success', __('Cache Cleared Successfully'));
    }

    public function globalSearch(Request $request)
    {
        $customers = User::where([
            'role' => 'user',
            'status' => 1,
        ])
        ->where('name', 'LIKE', '%'. $request->input('search').'%')
        ->where('username', 'LIKE', '%'. $request->input('search').'%')
        ->limit(10)
        ->get();


        return response()->json([
            'html' => view('layouts.backend.partials.searchresult', compact('customers'))->render()
        ]);
    }
}
