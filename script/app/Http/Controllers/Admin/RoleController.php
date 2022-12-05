<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:role.list')->only('index', 'show');
        $this->middleware('permission:role.create')->only('create', 'store');
        $this->middleware('permission:role.update')->only('edit', 'update');
        $this->middleware('permission:role.delete')->only('destroy');
    }

    public function index()
    {
        $roles = Role::where('id','!=',1)->get();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permisions = Permission::all();
        $permission_groups = User::getPermissionGroup();
        return view('admin.role.create', compact('permisions', 'permission_groups'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles|max:100',
        ]);
        $role = Role::create(['name' => $request->name]);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return response()->json(__('Role Created Successfully'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::findById($id);
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('admin.role.edit', compact('role', 'all_permissions', 'permission_groups'));
    }

    public function update(Request $request, $id)
    {
        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ], [
            'name.requried' => 'Please give a role name'
        ]);

        $role = Role::findById($id);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return response()->json(__('Role Updated Successfully'));
    }

    public function destroy(Request $request)
    {
        if ($request->status == 'delete') {
            if ($request->ids) {
                foreach ($request->ids as $id) {
                    Role::destroy($id);
                }
            }
        }
        return response()->json(__('Role Removed Successfully'));
    }
}
