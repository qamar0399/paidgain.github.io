<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $footer = get_option('footer_setting', true, current_locale());
        return view('admin.website.footer', compact('footer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'copyright' => ['required', 'string'],
            'social' => ['nullable', 'array']
        ]);

        

        $data = [
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'copyright' => $request->input('copyright'),
            'social' => $request->social ?? []
        ];

        $option = Option::firstOrNew([
            'key' => 'footer_setting',
            'lang' => current_locale()
        ]);

        $option->value = json_encode($data);
        $option->save();

        cache()->forget('footer_setting');

        return response()->json(__('Footer Settings Updated'));
    }
}
