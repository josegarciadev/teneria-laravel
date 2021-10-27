<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineProduct;
use Barryvdh\DomPDF\Facade as PDF;
class LineProductController extends Controller
{
    public function addLineProduct(Request $request){

        $data = $request->validate([
            "product_provider_id"=>'required',
            "line_id"=>'required',
            "stock"=>'required'
        ]);
        $exist = LineProduct::where('product_provider_id',$request->product_provider_id)->where('line_id',$request->line_id)->first();

        if(!$exist){
            $product_provider = LineProduct::create($data);
            return response()->json(['message'=>'Agregado con exito'], 200 );
        }
        
        $exist->stock = $request->stock;
        $exist->save();
        return response()->json(['message'=>'Actualizado con exito'], 200);
    }
    
    public function getAllLineProduct(){
        return LineProduct::select('line_products.id','line_products.created_at','line_products.line_id','line_products.product_provider_id','line_products.stock','lines.name as line_name','products.name as product_name','providers.name as provider_name','departments.name as department_name','line_products.delete')
                            ->join('lines','line_products.line_id','=','lines.id')
                            ->join('departments','lines.department_id','=','departments.id')
                            ->join('product_provider','line_products.product_provider_id','=','product_provider.id')
                            ->join('products','product_provider.product_id','=','products.id')
                            ->join('providers','product_provider.provider_id','=','providers.id')
                            ->orderBy('id', 'asc')
                            ->get();
    }

    public function GetLineProduct(Request $request, $id){
        $LineProduct = LineProduct::findOrFail($id);
    
        return $LineProduct;
    }
    
    public function UpdateLineProduct(Request $request, $id){
        $LineProduct = LineProduct::findOrFail($id);
        $LineProduct->product_provider_id = $request->product_provider_id;
        $LineProduct->line_id = $request->line_id;
        $LineProduct->stock = $request->stock;
        $LineProduct->delete = $request->delete;
        $LineProduct->save();
        try {
            return response()->json(['message'=>'Actualizado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function DeleteLineProduct(Request $request, $id){
        $LineProduct = LineProduct::findOrFail($id);
        $LineProduct->delete();
        try {
            return response()->json(['message'=>'Eliminado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function getPDFLineProduct(Request $request){
        $lineProduct = LineProduct::select('line_products.id','line_products.created_at','line_products.line_id','line_products.product_provider_id','line_products.stock','lines.name as line_name','products.name as product_name','providers.name as provider_name','departments.name as department_name','line_products.delete')
                                ->join('lines','line_products.line_id','=','lines.id')
                                ->join('departments','lines.department_id','=','departments.id')
                                ->join('product_provider','line_products.product_provider_id','=','product_provider.id')
                                ->join('products','product_provider.product_id','=','products.id')
                                ->join('providers','product_provider.provider_id','=','providers.id')
                                ->orderBy('id', 'asc')
                                ->get();

        view()->share('lineProduct', $lineProduct);
        $pdf = PDF::loadView('pdf_lineProduct', $lineProduct);
        return $pdf->download('pdf_lineProduct_'.now().'.pdf');
    }
}
