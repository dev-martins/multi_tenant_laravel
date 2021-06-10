<?php

namespace App\Http\Controllers\ACL;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function index()
    {
        try {

            $roles = Role::get();
            // $this->authorize('list-post', $posts);

            return response()->json($roles, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }

    public function getRole($id)
    {
        try {

            $roles = Role::find($id);
            if (!is_null($roles)) {
                return response()->json($roles, 200);
            }
            return response()->json(['msg' => 'Role não encontrado'], 404);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }

    public function createRole(Request $request)
    {
        try {
            Role::create($request->all());
            return response()->json(['msg' => 'Role cadastrado!'], 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'line' => $th->getLine()], 500);
        }
    }

    public function updateRole(Request $request, $id)
    {
        try {

            $role = Role::find($id);

            if (!$role) {
                return response()->json(["msg" => 'Role não encontrado!'], 404);
            }

            $role->update($request->all());

            return response()->json(['msg' => 'Role atualizado!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'line' => $th->getLine()], 500);
        }
    }

    public function deleteRole($id)
    {
        try {
            $role = Role::find($id);
            $role->delete($id);
            return response()->json(['msg' => 'Role removido!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'line' => $th->getLine()], 500);
        }
    }
}
