<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductProvider;
use Barryvdh\DomPDF\Facade as PDF;
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
        $product = Product::select()->orderBy('id', 'asc')
        ->get();
        $product->map(function($value){
            $value->typeProduct;
        });
        return $product;
    }

    public function GetAllProdProv(Request $request){
        $productprov = ProductProvider::select('product_provider.id','product_provider.product_id','product_provider.provider_id','providers.name as provider_name','products.name as product_name')->join('products','product_provider.product_id','=','products.id')->join('providers','product_provider.provider_id','=','providers.id')->get();
        return $productprov;
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
        $Product->delete = $request->delete;
        $Product->save();
        try {
            return response()->json(['message'=>'Actualizado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function DeleteProduct(Request $request, $id){
        $Product = Product::findOrFail($id);
        $Product->delete =true;
        $Product->save();
        try {
            return response()->json(['message'=>'Eliminado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addProductProvider(Request $request){

        $product = Product::findOrFail($request->product_id);

        $product->providers()->syncWithoutDetaching($request->provider_id);

        try {
            return response()->json(['message'=>'Agregado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function deleteProdProv(Request $request){

        $product = Product::findOrFail($request->product_id);

        $product->providers()->detach($request->provider_id);

        try {
            return response()->json(['message'=>'eliminado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getPDFProduct(Request $request){
        $product = Product::select('products.name','products.id','products.code','products.delete','products.created_at','type_products.name as type')->join('type_products','products.type_product_id','=','type_products.id')->orderBy('products.id', 'asc')
        ->get();

        view()->share('product', $product);
        $pdf = PDF::loadView('pdf_product', $product);
        return $pdf->download('pdf_product_'.now().'.pdf');
    }

    public function getPDFProductProvider(Request $request){
        $productprov = ProductProvider::select('product_provider.id','product_provider.product_id','product_provider.provider_id','providers.name as provider_name','products.name as product_name')->join('products','product_provider.product_id','=','products.id')->join('providers','product_provider.provider_id','=','providers.id')->get();

        view()->share('productprov', $productprov);
        $pdf = PDF::loadView('pdf_productProd', $productprov);
        return $pdf->download('pdf_productProd'.now().'.pdf');
    }
}
