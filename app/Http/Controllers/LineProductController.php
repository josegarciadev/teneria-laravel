<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineProduct;

class LineProductController extends Controller
{
    public function addLineProduct(Request $request){
        //return 'sa';
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

    /* public function addLineProduct(Request $request){
        //return 'sa';
        $data = $request->validate([
            "product_provider_id"=>'required',
            "line_id"=>'required',
            "stock"=>'required'
        ]);
        $product_provider = LineProduct::create($data);

        return $product_provider;
    } */
}
