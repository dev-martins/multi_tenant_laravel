<?php

namespace App\Http\Controllers\ACL;

use App\Models\RoleUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleUserController extends Controller
{
    private $role_user;

    public function __construct()
    {
        $this->role_user = new RoleUser();
    }

    public function linkUserRole(Request $request)
    {
        try {

            $this->role_user->create($request->all());
            return response()->json(["msg" => "Vinculo role_user criado!"], 201);
        } catch (\Throwable $th) {
            return response()->json(["msg" => [$th->getMessage()]], 500);
        }
    }
}
