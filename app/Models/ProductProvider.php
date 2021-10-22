<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProvider extends Model
{
    use HasFactory;

    protected $table = 'product_provider';


    public function lineProduct(){
        return $this->hasMany('App\Models\LineProduct','product_provider_id');
    }
}
