<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Provider;
use App\Models\Product;
use App\Models\Line;
use App\Models\Department;
use App\Models\Employee;
class StatisticsController extends Controller
{
    public function getStatistics(Request $request){
        $user = User::select()->count();
        $providers = Provider::select()->count();
        $products = Product::select()->count();
        $line = Line::select()->count();
        $departments = Department::select()->count();
        $employees = Employee::select()->count();
    return response()->json([
        "users"=>$user,
        "providers"=>$providers,
        "products"=>$products,
        "lines"=>$line,
        "departments"=>$departments,
        "employees"=>$employees,
    ], 200);
    }
}
