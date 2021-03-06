<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineProductLog;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\LineProduct;
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
       
        $lineProduct = LineProduct::findOrFail($request->line_product_id);

        if($lineProduct){

            if($request->line_product_scenes_id==2){
               if( $lineProduct->stock < $request->count){
                    return response()->json(['message'=>'No puede ser mayor a la cantidad existente'], 400 );
               }else{
                $lineProduct->stock = $lineProduct->stock - $request->count;
                $lineProduct->save();
               }    
            }else if($request->line_product_scenes_id==1){
                $lineProduct->stock = $lineProduct->stock + $request->count;
                $lineProduct->save();
            }
            $product_provider = LineProductLog::create($data);
            return response()->json(['message'=>'Agregado con exito'], 200 );
        }else{
            return response()->json(['message'=>'Linea Producto no existe'], 400 );
        }
         


         
    }
    
    public function getAllLineProductLog(){
        return LineProductLog::select('line_product_logs.id','line_product_logs.employee_id','line_product_logs.created_at','line_product_logs.count','lines.name as line_name','products.name as product_name','line_product_logs.delete','line_product_scenes.name as type','employees.name as employee_name','line_product_logs.line_product_id','line_product_logs.line_product_scenes_id')
        ->join('line_products','line_product_logs.line_product_id','=','line_products.id')
        ->join('employees','line_product_logs.employee_id','=','employees.id')
        ->join('line_product_scenes','line_product_logs.line_product_scenes_id','=','line_product_scenes.id')
        ->join('lines','line_products.line_id','=','lines.id')
        ->join('product_provider','line_products.product_provider_id','=','product_provider.id')
        ->join('products','product_provider.product_id','=','products.id')
        ->orderBy('id', 'asc')->get();
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
    public function getPDFLineProductLog(Request $request){
        $LineProductLog =  LineProductLog::select('line_product_logs.id','line_product_logs.employee_id','line_product_logs.created_at','line_product_logs.count','lines.name as line_name','products.name as product_name','line_product_logs.delete','line_product_scenes.name as type','employees.name as employee_name','line_product_logs.line_product_id','line_product_logs.line_product_scenes_id')
                    ->join('line_products','line_product_logs.line_product_id','=','line_products.id')
                    ->join('employees','line_product_logs.employee_id','=','employees.id')
                    ->join('line_product_scenes','line_product_logs.line_product_scenes_id','=','line_product_scenes.id')
                    ->join('lines','line_products.line_id','=','lines.id')
                    ->join('product_provider','line_products.product_provider_id','=','product_provider.id')
                    ->join('products','product_provider.product_id','=','products.id')
                    ->orderBy('id', 'asc')->get();
        view()->share('lineProductLog', $LineProductLog);
        $pdf = PDF::loadView('pdf_lineProductLogs', $LineProductLog);
        return $pdf->download('pdf_lineProductLogs_'.now().'.pdf');
    }
}
