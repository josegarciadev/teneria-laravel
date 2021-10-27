<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use Barryvdh\DomPDF\Facade as PDF;
class ProviderController extends Controller
{
    public function CreateProvider(Request $request){
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        Provider::create($data);
        try {
            return response()->json(['message'=>'Registrado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function GetAllProvider(Request $request){
        return Provider::select()->orderBy('id', 'asc')
        ->get();
    }

    public function GetProvider(Request $request, $id){
        $Provider = Provider::findOrFail($id);
        
        return $Provider;
    }
    
    public function UpdateProvider(Request $request, $id){
        $Provider = Provider::findOrFail($id);

        $Provider->name = $request->name;
        $Provider->delete = $request->delete;
        $Provider->save();
        try {
            return response()->json(['message'=>'Actualizado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function DeleteProvider(Request $request, $id){
        $Provider = Provider::findOrFail($id);
        $Provider->delete = true;
        $Provider->save();
        try {
            return response()->json(['message'=>'Eliminado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getPDFProvider(Request $request){
        $provider = Provider::select()->orderBy('id', 'asc')
        ->get();

        view()->share('provider', $provider);
        $pdf = PDF::loadView('pdf_provider', $provider);
        return $pdf->download('pdf_provider_'.now().'.pdf');
    }
}
