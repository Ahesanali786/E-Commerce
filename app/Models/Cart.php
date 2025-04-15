<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['qty','user_id','product_id ','products_variants ','created_at', 'updated_at'];
    protected $table ='carts';


    public function product(){
        return $this->belongsTo(Products::class);
    }
    public function user(){
        return $this->belongsTo(user::class);
    }
}
