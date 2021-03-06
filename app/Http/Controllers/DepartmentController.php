<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Barryvdh\DomPDF\Facade as PDF;
class DepartmentController extends Controller
{
    
    public function CreateDepartment(Request $request){
        $data = $request->validate([
            'name' => 'required|string|min:4|unique:departments',
            'description'=>'nullable'
        ]);

        Department::create($data);
        try {
            return response()->json(['message'=>'Registrado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function GetAllDepartment(Request $request){
        return Department::select()->orderBy('id', 'asc')
        ->get();
    }

    public function GetDeparment(Request $request, $id){
        $department = Department::findOrFail($id);
        
        return $department;
    }
    
    public function UpdateDeparment(Request $request, $id){
        $department = Department::findOrFail($id);

        $department->name = $request->name;
        $department->description = $request->description;
        $department->save();
        try {
            return response()->json(['message'=>'Actualizado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function DeleteDeparment(Request $request, $id){
        $department = Department::findOrFail($id);
        $department->delete=true;
        $department->save();
        try {
            return response()->json(['message'=>'Eliminado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getPDFDepartment(Request $request){
        $departments = Department::select()->orderBy('id', 'asc')
        ->get();
        view()->share('departments', $departments);
        $pdf = PDF::loadView('pdf_departments', $departments);
        return $pdf->download('pdf_departments_'.now().'.pdf');
    }
}
