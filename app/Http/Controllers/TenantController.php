<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function getAllTenants()
    {
        try {
            $data = Tenant::all();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Falha ao tentar listar Tenants!'], 500);
        }
    }

    public function getTenant($id){
        try {
            $data = Tenant::find($id);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function createTenant(Request $request)
    {
        try {
            Tenant::create($request->input());
            return response()->json(['msg' => 'Tenant cadastrado!'], 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Falha ao tentar cadastrar Tenant!'], 500);
        }
    }

    public function updateTenant(Request $request, $id)
    {
        try {
            Tenant::where('id', $id)
                ->update($request->all());
                return response()->json(['msg' => 'Tenant atualizado!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Falha ao tentar atualizar Tenant!'], 500);
        }
    }

    public function deleteTenant($id)
    {
        try {
            Tenant::destroy($id);
            return response()->json(['msg' => 'Tenant removido!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Falha ao tentar remover Tenant!'], 500);
        }
    }
}
