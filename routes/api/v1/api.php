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

Route::prefix('/PDF')->group(function(){
    Route::get('/usersPdf','App\Http\Controllers\UserController@getPDFUsers');
    Route::get('/departmentsPdf','App\Http\Controllers\DepartmentController@getPDFDepartment');
    Route::get('/employeesPdf','App\Http\Controllers\EmployeeController@getPDFEmployee');
    Route::get('/employeesLogsPdf','App\Http\Controllers\EmployeeLogController@getPDFEmployeeLogs');
    Route::get('/linesPdf','App\Http\Controllers\LineController@getPDFLines');
    Route::get('/linesProductsPdf','App\Http\Controllers\LineProductController@getPDFLineProduct');
    Route::get('/linesProductsLogsPdf','App\Http\Controllers\LineProductLogController@getPDFLineProductLog');
    Route::get('/productsPdf','App\Http\Controllers\ProductController@getPDFProduct');
    Route::get('/productsProviderPdf','App\Http\Controllers\ProductController@getPDFProductProvider');
    Route::get('/providerPdf','App\Http\Controllers\ProviderController@getPDFProvider');
});

Route::prefix('/statistics')->group(function(){
    Route::get('/getAll','App\Http\Controllers\StatisticsController@getStatistics');

});

Route::prefix('logs')->group(function(){
    Route::group(['middleware' => ['auth:api','role:admin|root|user']], function () {
        /*
        * employeeLogs
        */
        Route::prefix('/employeeLogs')->group(function(){
            Route::get('/all','App\Http\Controllers\EmployeeLogController@GetAllEmployeeLog');
            Route::get('/getOne/{id}','App\Http\Controllers\EmployeeLogController@GetEmployeeLog');
            Route::post('/create','App\Http\Controllers\EmployeeLogController@CreateEmployeeLog');
            Route::patch('/update/{id}','App\Http\Controllers\EmployeeLogController@UpdateEmployeeLog');
            Route::delete('/delete/{id}','App\Http\Controllers\EmployeeLogController@DeleteEmployeeLog');
        });

        
        /*
        * LineProdLogs
        */
        Route::prefix('/employee')->group(function(){
            Route::get('/all','App\Http\Controllers\EmployeeController@GetAllEmployee');
        });
        
        Route::prefix('/lineProd')->group(function(){
            Route::get('/all','App\Http\Controllers\LineProductController@getAllLineProduct');
        });

        Route::prefix('/lineProdLog')->group(function(){
            Route::get('/all','App\Http\Controllers\LineProductLogController@getAllLineProductLog');
            Route::get('/getOne/{id}','App\Http\Controllers\LineProductLogController@GetLineProductLog');
            Route::post('/create','App\Http\Controllers\LineProductLogController@addLineProductLog');
            Route::patch('/update/{id}','App\Http\Controllers\LineProductLogController@UpdateLineProductLog');
            Route::delete('/delete/{id}','App\Http\Controllers\LineProductLogController@DeleteLineProductLog');
        });
    });
        
});
Route::prefix('/ROOT')->group(function(){
    Route::group(['middleware' => ['auth:api','role:root']], function () {
        /*
        * Audit
        */
        Route::prefix('/audit')->group(function(){
            Route::get('/all','App\Http\Controllers\AuditController@getAllAudit');
        });
        Route::prefix('/user')->group(function(){
            Route::post('/createAdmin','App\Http\Controllers\LoginController@registerAdmin');
        });
    });
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
            Route::get('/getOne/{id}','App\Http\Controllers\EmployeeController@GetEmployee');
            Route::post('/create','App\Http\Controllers\EmployeeController@CreateEmployee');
            Route::patch('/update/{id}','App\Http\Controllers\EmployeeController@UpdateEmployee');
            Route::delete('/delete/{id}','App\Http\Controllers\EmployeeController@DeleteEmployee');
        });
    
        
        /*
        * Line
        */
        Route::prefix('/line')->group(function(){
            Route::get('/all','App\Http\Controllers\LineController@GetAllLine');
            Route::get('/getOne/{id}','App\Http\Controllers\LineController@GetLine');
            Route::post('/create','App\Http\Controllers\LineController@CreateLine');
            Route::patch('/update/{id}','App\Http\Controllers\LineController@UpdateLine');
            Route::delete('/delete/{id}','App\Http\Controllers\LineController@DeleteLine');
        });
        /*
        * lineProd
        */
        Route::prefix('/lineProd')->group(function(){
            
            Route::get('/getOne/{id}','App\Http\Controllers\LineProductController@GetLineProduct');
            Route::post('/create','App\Http\Controllers\LineProductController@addLineProduct');
            Route::patch('/update/{id}','App\Http\Controllers\LineProductController@UpdateLineProduct');
            Route::delete('/delete/{id}','App\Http\Controllers\LineProductController@DeleteLineProduct');
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

            Route::post('/prodprov','App\Http\Controllers\ProductController@addProductProvider');
            Route::get('/prodprov/all','App\Http\Controllers\ProductController@GetAllProdProv');
            Route::post('/prodprov/delete','App\Http\Controllers\ProductController@deleteProdProv');
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
        
        Route::prefix('/user')->group(function(){
            Route::get('/all','App\Http\Controllers\UserController@getAllUser');
            Route::patch('/update/{id}','App\Http\Controllers\UserController@updateUser');
            Route::delete('/delete/{id}','App\Http\Controllers\UserController@deleteUser');
        });
    });
});

 


