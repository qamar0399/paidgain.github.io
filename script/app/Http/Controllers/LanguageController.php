<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        Session::put('locale',$request->value);
        return response()->json('success');
    }
}
