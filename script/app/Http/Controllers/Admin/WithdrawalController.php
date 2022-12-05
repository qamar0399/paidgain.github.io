<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:withdrawlmethod.list')->only('index', 'show', 'pending', 'approved', 'rejected', 'log');
        $this->middleware('permission:withdrawlmethod.create')->only('create', 'store', 'createMethod', 'storeMethod');
        $this->middleware('permission:withdrawlmethod.update')->only('edit', 'update');
        $this->middleware('permission:withdrawlmethod.delete')->only('destroy');
    }

    public function pending()
    {
        return view('admin.withdraw.pending');
    }

    public function approved()
    {
        return view('admin.withdraw.approved');
    }

    public function rejected()
    {
        return view('admin.withdraw.rejected');
    }

    public function log()
    {
        return view('admin.withdraw.log');
    }
}
