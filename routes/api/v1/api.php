<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 */

Route::prefix('/user')->group(function(){

    Route::middleware('auth:api')->group(function () {
        Route::get('/currentUser','App\Http\Controllers\UserController@currentUser');
    });

    Route::get('/test','App\Http\Controllers\LoginController@test');
    Route::post('/login','App\Http\Controllers\LoginController@login');
    Route::post('/register','App\Http\Controllers\LoginController@register');
});

