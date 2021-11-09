<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditController extends Controller
{
    
    public function getAllAudit(Request $request){
        return  DB::table('audit_tables')->get();
    }
}
