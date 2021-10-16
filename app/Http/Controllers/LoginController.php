<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    //

    public function login(Request $request){
        $credentials = $request->only('email','password');
        if( !Auth::attempt($credentials)){
            return response()->json([
                'message'=> 'usuario y/o contraseña es invalida'
            ], 422);
        }

        $accessToken = Auth::user()->createToken('authTeneriaToken')->accessToken;

        return response([
            'user'=> Auth::user(),
            'access_token'=>$accessToken
        ]);
    }
    public function register(Request $request){
        $data = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string|min:8',
            'name'=> 'required|string|min:8'
        ]);

        $user = User::create($data)->assignRole('user');
        
        $accessToken = $user->createToken('authTeneriaToken')->accessToken;
        return response([
            'user'=> $user,
            'access_token'=>$accessToken
        ]);
    }
    public function test(){
        return 'test';
    }
}
