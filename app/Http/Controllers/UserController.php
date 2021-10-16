<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function currentUser(Request $request){
        return response([
            'user'=> $request->user()
        ]);
    }
}
