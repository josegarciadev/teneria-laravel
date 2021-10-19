<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable=[
        'code',
        'name',
        'type_product_id'
    ];

    public function typeProduct(){
        return $this->belongsTo('App\Models\TypeProduct');
    }

}
