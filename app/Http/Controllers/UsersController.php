<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function createUser(Request $request)
    {
        try {
            $data = $request->input();
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            $user->token = $user->createToken($user->email)->accessToken;
            return response()->json($user, 201);
        } catch (\Throwable $th) {
            return response()->json(["errors" => [$th->getMessage()]], 500);
        }
    }

    public function loginUser(Request $request)
    {
        try {

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $user->token = $user->createToken($user->email)->accessToken;
                return response()->json($user, 200);
            }
            return response()->json(["msg" => ["Credenciais inválidas"]], 401);
        } catch (\Throwable $th) {
            return response()->json(["msg" => [$th->getMessage()]], 500);
        }
    }
}
