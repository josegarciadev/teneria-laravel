<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function currentUser(Request $request){

        $user = $request->user();
        
        return response([
            'user'=> $user,
            "roles" => $user->getRoleNames(),
        ]);
    }

    public function getAllUser(Request $request){
        $user = User::select()->orderBy('id', 'asc')
                        ->get();

        $user->map(function ($user) {
             $user->getRoleNames();
        });
        return $user;
    }
    public function deleteUser(Request $request,$id){
        $user = User::findOrFail($id);
        $user->delete=true;
        $user->save();
        try {
            return response()->json(['message'=>'Eliminado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateUser(Request $request,$id){
        $user = User::findOrFail($id);
        $user->email=$request->email;
        $user->name=$request->name;
        $user->delete=$request->delete;
        if($request->password){
            $user->password=bcrypt($request->password);
        }

        $user->save();
        try {
            return response()->json(['message'=>'actualizado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
