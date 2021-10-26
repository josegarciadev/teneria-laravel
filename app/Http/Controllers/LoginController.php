<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class LoginController extends Controller
{
    //

    public function login(Request $request){
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($login)) {
            $user = Auth::user();

            if($user->delete){
                return response(['message' => 'Invalid Login, User delete'], 401);
            }else{
                $token = $user->createToken('authToken');
            $accessToken = $token->accessToken;

            if ($request->get('remember_me')) {
                $token->token->expires_at = Carbon::now()->addDays(30);
            } else {
                $token->token->expires_at = Carbon::now()->addDays(7);
            }

            $token->token->save();
            $expiration = $token->token->expires_at;
            
            return response()->json([
                "user" =>$user,
                "token" => $accessToken,
                "expired_in" => $expiration,
                "verified" => $user->hasVerifiedEmail(),
                "roles" => $user->getRoleNames(),
                "permissions" => $user->getAllPermissions()
            ], 200);
            }
            
        } else {
            return response(['message' => 'Invalid Login'], 401);
        }
    }


    public function register(Request $request){
        $data = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string|min:8',
            'name'=> 'required|string|min:8'
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data)->assignRole('user');
        
        $accessToken = $user->createToken('authToken')->accessToken;
        return response([
            'user'=> $user,
            'access_token'=>$accessToken
        ]);
    }


    public function test(){
        return 'test';
    }
}
