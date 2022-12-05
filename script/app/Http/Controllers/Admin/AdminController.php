<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Term;
use App\Models\Category;
use App\Models\Media;

class AdminController extends Controller
{
    /*
    return admin dashboard view
    */
    public function Dashboard()
    {
        abort_if(!Auth()->user()->can('dashboard'), 401);
        $recent_deposits = Deposit::latest()->whereHas('user')->whereHas('getway')->with('user','getway')->limit(25)->get();
        $recent_withdraws = Withdraw::latest()->whereHas('user')->whereHas('method')->with('user','method')->limit(25)->get();
        

        return view('admin.dashboard', compact('recent_deposits', 'recent_withdraws'));
    }

    public function settings()
    {
        return view('admin.admin.settings');
    }

    public function genUpdate(Request $request)
    {
        $request->validate([
            'file' => 'image',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'name' => 'required',
        ]);

        $info = User::find(Auth::id());


        $user = User::find(Auth::id());

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();


        return response()->json(['Update Success']);

    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
        $info = User::where('id', Auth::id())->first();

        $check = Hash::check($request->current, auth()->user()->password);

        if ($check == true) {
            User::where('id', Auth::id())->update(['password' => Hash::make($request->password)]);

            return response()->json(['Password Changed']);
        } else {
            return Response()->json(array(
                'message' => "Enter Valid Password"
            ), 401);
        }
    }

    public function index()
    {
        abort_if(!Auth()->user()->can('admin.list'), 401);

        $users = User::where('role', 'admin')->where('id', '!=', 1)->latest()->get();
        return view('admin.admin.index', compact('users'));
    }

    public function create()
    {
        if (Auth()->user()->can('admin.create')) {
            $roles = Role::all();
            return view('admin.admin.create', compact('roles'));
        }
    }

    public function store(Request $request)
    {
        // Validation Data
        $request->validate([
            'name' => 'required|max:50',
            'roles' => 'required',
            'email' => 'required|max:100|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create New User
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 'admin';
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        return response()->json(['User has been created !!']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (Auth()->user()->can('admin.edit')) {
            $user = User::find($id);
            $roles = Role::all();
            return view('admin.admin.edit', compact('user', 'roles'));
        }
    }

    public function update(Request $request, $id)
    {
        // Create New User
        $user = User::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        return response()->json(['User has been updated !!']);
    }

    public function destroy(Request $request)
    {
        if (Auth()->user()->can('admin.delete')) {
            if ($request->status == 'delete') {
                if ($request->ids) {
                    foreach ($request->ids as $id) {
                        User::destroy($id);
                    }
                }
            } else {
                if ($request->ids) {
                    foreach ($request->ids as $id) {
                        $post = User::find($id);
                        $post->status = $request->status;
                        $post->save();
                    }
                }
            }
        }

        return response()->json('Success');
    }
}
