<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable=[
        'name',
        'description'
    ];

    public function employees(){
        return $this->hasMany('App\Models\Employee','department_id');
    }

    public function lines(){
        return $this->hasMany('App\Models\Line','department_id');
    }
}
