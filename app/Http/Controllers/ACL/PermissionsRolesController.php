<?php

namespace App\Http\Controllers\ACL;

use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsRolesController extends Controller
{
    private $permission_role;

    public function __construct()
    {
        $this->permission_role = new PermissionRole();
    }

    public function linkRolePermission(Request $request)
    {
        try {
            $this->permission_role->create($request->all());
            return response()->json(["msg" => "Vinculo permission_rule criado!"], 201);
        } catch (\Throwable $th) {
            return response()->json(["msg" => $th->getMessage()], 500);
        }
    }
}
