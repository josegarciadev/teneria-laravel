<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function currentUser(Request $request){

        $user = $request->user();
        
        return response([
            'user'=> $user,
            "roles" => $user->getRoleNames(),
        ]);
    }
}
