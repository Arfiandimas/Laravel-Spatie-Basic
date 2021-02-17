<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionViaRoleContoller extends Controller
{
    public function index($role_id)
    {
        try {
            $response = Role::with('permissions')->where('id', $role_id)->get();
            return ngcApiReturn($response);
        } catch (\Exception $e) {
            return ngcApiCatch($e);
        }
    }

    public function store(Request $request, $role_id)
    {
        $request->validate([
            'name' => 'required|array',
            'name.*' => 'exists:permissions,name'
        ]);

        try {
            $role = Role::find($role_id);
            $permission = $request->name;
            $role->givePermissionTo($permission);
            $response = $role::with('permissions')->where('id', $role_id)->first();
            return ngcApiCreated($response);
        } catch (\Exception $e) {
            return ngcApiCatch($e);
        }
    }
}
