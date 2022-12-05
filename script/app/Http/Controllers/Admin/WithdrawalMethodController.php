<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;

class WithdrawalMethodController extends Controller
{
    public function index()
    {
        $methods = WithdrawMethod::withCount('withdraws')->latest()->paginate(10);
        return view('admin.withdraw.methods.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.withdraw.methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'image' => ['required', 'string'],
            'rate' => ['required', 'numeric', 'gt:0'],
            'delay' => ['required', 'numeric'],
            'currency' => ['required', 'string'],
            'min_limit' => ['required', 'gt:0'],
            'max_limit' => ['required', 'after_or_equal:min_limit'],
            'fixed_charge' => ['nullable', 'gt:0'],
            'percent_charge' => ['nullable', 'between:0,100'],
            'instruction' => ['required', 'string'],
        ]);

        $method = WithdrawMethod::create($request->all());

        return response()->json(__('Withdraw Method Created Successfully'));
    }

    public function edit($id)
    {
        $method = WithdrawMethod::find($id);
        return view('admin.withdraw.methods.edit', compact('method'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'image' => ['required', 'string'],
            'rate' => ['required', 'numeric', 'gt:0'],
            'delay' => ['required', 'numeric'],
            'currency' => ['required', 'string'],
            'min_limit' => ['required', 'gt:0'],
            'max_limit' => ['required', 'after_or_equal:min_limit'],
            'fixed_charge' => ['nullable', 'gt:0'],
            'percent_charge' => ['nullable', 'between:0,100'],
            'instruction' => ['required', 'string'],
        ]);

        $method = WithdrawMethod::find($id);
        $method->update($request->all());

        return response()->json(__('Withdraw Method Updated Successfully'));
    }

    public function deleteAll(Request $request)
    {
        foreach ($request->ids as $id) {
             WithdrawMethod::doesnthave('withdraws')->where('id',$id)->delete();
           
        }
        return response()->json(__('Withdraw Method Deleted Successfully'));
    }

}
