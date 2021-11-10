<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;

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

    public function getPDFUsers(Request $request){
        $users = User::select()->orderBy('id', 'asc')
                        ->get();

        $users->map(function ($user) {
             $user->getRoleNames();
        });
        view()->share('users', $users);
        $pdf = PDF::loadView('pdf_users', $users);

        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        return $pdf->download('users_'.now().'.pdf');
    }
}
