<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;


class EmployeeController extends Controller
{
    public function CreateEmployee(Request $request){
        $data = $request->validate([
            'dni'=>'required|string',
            'name' => 'required|string',
            'date_birth'=>'required',
            'ingress'=>'required',
            'address'=>'required',
            'phone_number'=>'nullable',
            'gender_id'=>'required',
            'department_id'=>'required',
        ]);

        Employee::create($data);
        try {
            return response()->json(['message'=>'Registrado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function GetAllEmployee(Request $request){
        $Employees =Employee::where('delete',false)->get();

        $Employees->map(function($value){
            $value->gender;
            $value->department;
        });
        return $Employees;
    }

    public function GetEmployee(Request $request, $id){
        $Employee = Employee::findOrFail($id);
        $Employee->department;
        $Employee->gender;
        return $Employee;
    }
    
    public function UpdateEmployee(Request $request, $id){
        $Employee = Employee::findOrFail($id);

        $Employee->dni = $request->dni;
        $Employee->name = $request->name;
        $Employee->ingress = $request->ingress;
        $Employee->address = $request->address;
        $Employee->phone_number = $request->phone_number;
        $Employee->gender_id = $request->gender_id;
        $Employee->department_id = $request->department_id;
        $Employee->save();
        try {
            return response()->json(['message'=>'Actualizado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function DeleteEmployee(Request $request, $id){
        $Employee = Employee::findOrFail($id);
        $Employee->delete=true;
        $Employee->save();
        try {
            return response()->json(['message'=>'Eliminado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
