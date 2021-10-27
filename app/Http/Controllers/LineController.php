<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Line;
use Barryvdh\DomPDF\Facade as PDF;

class LineController extends Controller
{
    public function CreateLine(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'department_id'=>'required'
        ]);

        Line::create($data);
        try {
            return response()->json(['message'=>'Registrado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function GetAllLine(Request $request){
        return Line::select('lines.id','lines.name as line_name','lines.department_id','lines.delete','departments.name as department_name')
                    ->join('departments','lines.department_id','=','departments.id')
                    ->orderBy('id', 'asc')->get();
    }

    public function GetLine(Request $request, $id){
        $Line = Line::findOrFail($id);
        $Line->department;
        return $Line;
    }
    
    public function UpdateLine(Request $request, $id){
        $Line = Line::findOrFail($id);

        $Line->name = $request->name;
        $Line->department_id = $request->department_id;
        $Line->delete = $request->delete;
        $Line->save();
        try {
            return response()->json(['message'=>'Actualizado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function DeleteLine(Request $request, $id){
        $Line = Line::findOrFail($id);
        $Line->delete=true;
        $Line->save();
        try {
            return response()->json(['message'=>'Eliminado con exito'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getPDFLines(Request $request){
        $line = Line::select('lines.id','lines.name as line_name','lines.department_id','lines.delete','departments.name as department_name')
                    ->join('departments','lines.department_id','=','departments.id')
                    ->orderBy('id', 'asc')->get();

        view()->share('line', $line);
        $pdf = PDF::loadView('pdf_line', $line);
        return $pdf->download('pdf_line_'.now().'.pdf');
    }
}
