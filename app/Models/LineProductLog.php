<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineProductLog extends Model
{
    use HasFactory;

    protected $table = 'line_product_logs';
    protected $fillable=[
        'employee_id',
        'line_product_id',
        'line_product_scenes_id',
        'count'
    ];

    public function lineProductScene(){
        return $this->belongsTo('App\Models\LineProductScene');
    }

    public function employee(){
        return $this->belongsTo('App\Models\Employee');
    }

    public function lineProduct(){
        return $this->belongsTo('App\Models\LineProduct');
    }
}
