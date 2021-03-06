<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeLog;
use Barryvdh\DomPDF\Facade as PDF;

class EmployeeLogController extends Controller
{
    public function CreateEmployeeLog(Request $request){
        $data = $request->validate([
            'employee_id'=>'required',
            'employee_scene_id' => 'required',
            'date'=>'required',
            'description'=>'required'
        ]);

        EmployeeLog::create($data);
        try {
            return response()->json(['message'=>'Registrado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function GetAllEmployeeLog(Request $request){
        $EmployeeLog = EmployeeLog::select()->orderBy('id', 'asc')->get();;
        $EmployeeLog->map(function($value){
            $value->employeeScene;
            $value->employee;
        });
        return $EmployeeLog;
    }

    public function GetEmployeeLog(Request $request, $id){
        $EmployeeLog = EmployeeLog::findOrFail($id);
        $EmployeeLog->employeeScene;
        $EmployeeLog->employee;
        return $EmployeeLog;
    }
    
    public function UpdateEmployeeLog(Request $request, $id){
        $EmployeeLog = EmployeeLog::findOrFail($id);

        $EmployeeLog->employee_id = $request->employee_id;
        $EmployeeLog->employee_scene_id = $request->employee_scene_id;
        $EmployeeLog->date = $request->date;
        $EmployeeLog->description = $request->description;
        $EmployeeLog->delete = $request->delete;
        $EmployeeLog->save();
        try {
            return response()->json(['message'=>'Actualizado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function DeleteEmployeeLog(Request $request, $id){
        $EmployeeLog = EmployeeLog::findOrFail($id);
        $EmployeeLog->delete=true;
        $EmployeeLog->save();
        try {
            return response()->json(['message'=>'Eliminado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getPDFEmployeeLogs(Request $request){
        $EmployeeLog = EmployeeLog::select()->orderBy('id', 'asc')->get();;
        $EmployeeLog->map(function($value){
            $value->employee;
        });
        view()->share('employeesLogs', $EmployeeLog);
        $pdf = PDF::loadView('pdf_employeesLog', $EmployeeLog);
        return $pdf->download('pdf_employeesLog_'.now().'.pdf');
    }
}
