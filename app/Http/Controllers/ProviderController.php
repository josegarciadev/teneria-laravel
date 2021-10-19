<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;

class ProviderController extends Controller
{
    public function CreateProvider(Request $request){
        $data = $request->validate([
            'name' => 'required|string|min:4|unique:Providers'
        ]);

        Provider::create($data);
        try {
            return response()->json(['message'=>'Registrado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function GetAllProvider(Request $request){
        return Provider::all();
    }

    public function GetProvider(Request $request, $id){
        $Provider = Provider::findOrFail($id);
        
        return $Provider;
    }
    
    public function UpdateProvider(Request $request, $id){
        $Provider = Provider::findOrFail($id);

        $Provider->name = $request->name;
        $Provider->save();
        try {
            return response()->json(['message'=>'Actualizado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function DeleteProvider(Request $request, $id){
        $Provider = Provider::findOrFail($id);
        $Provider->delete();
        try {
            return response()->json(['message'=>'Eliminado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}