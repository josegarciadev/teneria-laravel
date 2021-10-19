<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeScene extends Model
{
    use HasFactory;

    protected $table = 'employee_scenes';
    protected $fillable=[
        'name',
    ];

    public function employeLogs(){
        return $this->hasMany('App\Models\EmployeeLog','employee_scene_id');
    }
}
