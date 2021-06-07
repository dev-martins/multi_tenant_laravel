<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function createTenant(Request $request)
    {
        try {
            Tenant::create($request->input());
            return response()->json(['msg' => 'Tenant cadastrado!'], 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Falha ao tentar cadastrar Tenant!'], 500);
        }
    }
}
