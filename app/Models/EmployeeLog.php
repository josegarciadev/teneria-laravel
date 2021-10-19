<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLog extends Model
{
    use HasFactory;

    protected $table = 'employee_logs';
    protected $fillable=[
        'employee_id',
        'employee_scene_id',
        'date',
        'description'
    ];

    public function employeeScene(){
        return $this->belongsTo('App\Models\EmployeeScene');
    }

    public function employee(){
        return $this->belongsTo('App\Models\Employee');
    }

}
