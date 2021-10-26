<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineProduct extends Model
{
    use HasFactory;

    protected $table = "line_products";

    protected $fillable = [
        "product_provider_id",
        "line_id",
        "stock"
    ];

    public function line(){
        return $this->belongsTo('App\Models\Line');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }

    public function lineProductLogs(){
        return $this->hasMany('App\Models\LineProductLog','line_product_id');
    }
}
