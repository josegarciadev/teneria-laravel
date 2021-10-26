<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineProductScene extends Model
{
    use HasFactory;
    protected $table = 'line_product_scenes';
    protected $fillable=[
        'name',
    ];

    public function lineProductLogs(){
        return $this->hasMany('App\Models\LineProductLog','line_product_scenes_id');
    }
}
