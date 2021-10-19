<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function CreateProduct(Request $request){
        $data = $request->validate([
            'code'=>'required|string|unique:products',
            'name' => 'required|string',
            'type_product_id'=>'required'
        ]);

        Product::create($data);
        try {
            return response()->json(['message'=>'Registrado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function GetAllProduct(Request $request){
        $product = Product::all();
        $product->map(function($value){
            $value->typeProduct;
        });
        return $product;
    }

    public function GetProduct(Request $request, $id){
        $Product = Product::findOrFail($id);
        $Product->typeProduct;
        return $Product;
    }
    
    public function UpdateProduct(Request $request, $id){
        $Product = Product::findOrFail($id);

        $Product->code = $request->code;
        $Product->name = $request->name;
        $Product->type_product_id = $request->type_product_id;
        $Product->save();
        try {
            return response()->json(['message'=>'Actualizado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function DeleteProduct(Request $request, $id){
        $Product = Product::findOrFail($id);
        $Product->delete();
        try {
            return response()->json(['message'=>'Eliminado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
