<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineProductLog;

class LineProductLogController extends Controller
{
    public function addLineProductLog(Request $request){
        //return 'sa';
        $data = $request->validate([
            "employee_id"=>'required',
            "line_product_id"=>'required',
            "line_product_scenes_id"=>'required',
            "count"=>'required'
        ]);
       
         $product_provider = LineProductLog::create($data);
         return response()->json(['message'=>'Agregado con exito'], 200 );
    }
    
    public function getAllLineProductLog(){
        return LineProductLog::where('delete',false)->get();
    }

    public function GetLineProductLog(Request $request, $id){
        $LineProductLog = LineProductLog::findOrFail($id);
    
        return $LineProductLog;
    }
    
    public function UpdateLineProductLog(Request $request, $id){
        $LineProductLog = LineProductLog::findOrFail($id);
        $LineProductLog->employee_id = $request->employee_id;
        $LineProductLog->line_product_id = $request->line_product_id;
        $LineProductLog->line_product_scenes_id = $request->line_product_scenes_id;
        $LineProductLog->count = $request->count;
        $LineProductLog->save();
        try {
            return response()->json(['message'=>'Actualizado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function DeleteLineProductLog(Request $request, $id){
        $LineProductLog = LineProductLog::findOrFail($id);
        $LineProductLog->delete=true;
        $LineProductLog->save();
        try {
            return response()->json(['message'=>'Eliminado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
