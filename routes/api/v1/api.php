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

/* Route::group(['middleware' => ['role:admin|partner', 'auth:api']], function () {
    Route::get('/currentUser','App\Http\Controllers\UserController@currentUser');
}); */
Route::prefix('/user')->group(function(){

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/currentUser','App\Http\Controllers\UserController@currentUser');
    }); 

    Route::get('/test','App\Http\Controllers\LoginController@test');
    Route::post('/login','App\Http\Controllers\LoginController@login');
    Route::post('/register','App\Http\Controllers\LoginController@register');
});

Route::prefix('/admin')->group(function(){
    Route::group(['middleware' => ['auth:api','role:admin|root']], function () {
        /*
        * Departments
        */
        Route::prefix('/department')->group(function(){
            Route::get('/all','App\Http\Controllers\DepartmentController@GetAllDepartment');
            Route::get('/getOne/{id}','App\Http\Controllers\DepartmentController@GetDeparment');
            Route::post('/create','App\Http\Controllers\DepartmentController@CreateDepartment');
            Route::patch('/update/{id}','App\Http\Controllers\DepartmentController@UpdateDeparment');
            Route::delete('/delete/{id}','App\Http\Controllers\DepartmentController@DeleteDeparment');
        });
    
        /*
        * Employees
        */
        Route::prefix('/employee')->group(function(){
            Route::get('/all','App\Http\Controllers\EmployeeController@GetAllEmployee');
            Route::get('/getOne/{id}','App\Http\Controllers\EmployeeController@GetEmployee');
            Route::post('/create','App\Http\Controllers\EmployeeController@CreateEmployee');
            Route::patch('/update/{id}','App\Http\Controllers\EmployeeController@UpdateEmployee');
            Route::delete('/delete/{id}','App\Http\Controllers\EmployeeController@DeleteEmployee');
        });
    
        /*
        * Employeeslogs
        */
        Route::prefix('/employeeLogs')->group(function(){
            Route::get('/all','App\Http\Controllers\EmployeeLogController@GetAllEmployeeLog');
            Route::get('/getOne/{id}','App\Http\Controllers\EmployeeLogController@GetEmployeeLog');
            Route::post('/create','App\Http\Controllers\EmployeeLogController@CreateEmployeeLog');
            Route::patch('/update/{id}','App\Http\Controllers\EmployeeLogController@UpdateEmployeeLog');
            Route::delete('/delete/{id}','App\Http\Controllers\EmployeeLogController@DeleteEmployeeLog');
        });

        /*
        * Products
        */
        Route::prefix('/product')->group(function(){
            Route::get('/all','App\Http\Controllers\ProductController@GetAllProduct');
            Route::get('/getOne/{id}','App\Http\Controllers\ProductController@GetProduct');
            Route::post('/create','App\Http\Controllers\ProductController@CreateProduct');
            Route::patch('/update/{id}','App\Http\Controllers\ProductController@UpdateProduct');
            Route::delete('/delete/{id}','App\Http\Controllers\ProductController@DeleteProduct');
        });
        /*
        * Provider
        */
        Route::prefix('/provider')->group(function(){
            Route::get('/all','App\Http\Controllers\ProviderController@GetAllProvider');
            Route::get('/getOne/{id}','App\Http\Controllers\ProviderController@GetProvider');
            Route::post('/create','App\Http\Controllers\ProviderController@CreateProvider');
            Route::patch('/update/{id}','App\Http\Controllers\ProviderController@UpdateProvider');
            Route::delete('/delete/{id}','App\Http\Controllers\ProviderController@DeleteProvider');
        });
        
    });
});

 

