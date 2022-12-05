<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use Auth;
use Cache;

class SeoController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:seo.settings');
    }

    public function index()
    {
        $data = Option::where('key', 'LIKE', '%seo_%')->get();

        return view('admin.seo.index', compact('data'));
    }

    public function edit($id)
    {
        $data = Option::where('id', $id)->first();
        return view('admin.seo.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $option = Option::where('id', $id)->first();

        $data = [
            "site_name" => $request->site_name,
            "matatag" => $request->matatag,
            "twitter_site_title" => $request->twitter_site_title,
            "matadescription" => $request->matadescription,
            "preview" => $request->preview,
        ];

        $value = json_encode($data);
        $option->value = $value;
        $option->save();

        Cache::forget($option->key);
        return response()->json(__('Setting Updated Successfully'));
    }


}
