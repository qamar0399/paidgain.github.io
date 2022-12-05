<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class CronController extends Controller
{
    public function index()
    {
        $option = Option::where('key', 'cron_option')->first();
        $option = json_decode($option->value ?? null);

        return view('admin.cron.index', compact('option'));
    }

    public function update(Request $request, $key)
    {
        $request->validate([
            'days' => ['required', 'integer'],
            'expirable_message' => ['required', 'string'],
            'expired_message' => ['required', 'string'],
            'trial_expired_message' => ['required', 'string'],
        ]);

        $option = Option::where('key', '=', $key)->firstOrNew();

        $option->key = $key;
        $option->value = json_encode([
            'days' => $request->input('days'),
            'expirable_message' => $request->input('expirable_message'),
            'expired_message' => $request->input('expired_message'),
            'trial_expired_message' => $request->input('trial_expired_message'),
        ]);
        $option->save();

        return $option;

        return response()->json(__('Cron Settings Successfully Updated'));
    }
}
