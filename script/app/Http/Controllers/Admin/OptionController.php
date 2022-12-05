<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Category;
use Cache;
class OptionController extends Controller
{
   public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:site.settings');
       
    }

    public function index()
    {
       $referralCommissionConfig = Category::where('type', '=', 'ReferralCommissionConfig')->pluck('status', 'name','status');
       return view('admin.settings.option',compact('referralCommissionConfig'));
    }

    public function update(Request $request,$key)
    {
       $option=Option::where('key',$key)->first();
       if ($option == null) {
          $option= new Option;
          $option->key = $key;
       }

       $option->value=json_encode($request->option);
       $option->save();

       Cache::forget($key);

       return response()->json(__('Settings Successfully Updated'));

    }

}
