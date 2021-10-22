<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use HasFactory;

    protected $table = 'lines';
    protected $fillable=[
        'name',
        'department_id'
    ];

    public function department(){
        return $this->belongsTo('App\Models\Department');
    }

    public function lineProduct(){
        return $this->hasMany('App\Models\LineProduct','line_id');
    }
}
