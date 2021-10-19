<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $fillable=[
        'dni',
        'name',
        'date_birth',
        'ingress',
        'address',
        'phone_number',
        'gender_id',
        'department_id',
    ];

    public function department(){
        return $this->belongsTo('App\Models\Department');
    }

    public function gender(){
        return $this->belongsTo('App\Models\Gender');
    }

    public function logs(){
        return $this->hasMany('App\Models\Employee','employee_id');
    }
    
}
