<?php

namespace App\Http\Controllers\ACL;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    public function index()
    {
        try {

            $permissions = Permission::get();
            // $this->authorize('list-post', $posts);

            return response()->json($permissions, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }

    public function getPermission($id)
    {
        try {

            $permission = Permission::find($id);
            if (!is_null($permission)) {
                return response()->json($permission, 200);
            }
            return response()->json(['msg' => 'Permission não encontrada'], 404);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }

    public function createPermission(Request $request)
    {
        try {
            Permission::create($request->all());
            return response()->json(['msg' => 'Permission cadastrada!'], 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'line' => $th->getLine()], 500);
        }
    }

    public function updatePermission(Request $request, $id)
    {
        try {

            $permission = Permission::find($id);

            if (!$permission) {
                return response()->json(["msg" => 'Permission não encontrada!'], 404);
            }

            $permission->update($request->all());

            return response()->json(['msg' => 'Permission atualizada!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'line' => $th->getLine()], 500);
        }
    }

    public function deletePermission($id)
    {
        try {
            $permission = Permission::find($id);
            $permission->delete($id);
            return response()->json(['msg' => 'Permission removida!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'line' => $th->getLine()], 500);
        }
    }
}
