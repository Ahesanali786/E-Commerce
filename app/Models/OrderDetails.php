<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = ['id','order_id', 'product_id','user_id', 'qty','product_price','total','products_variants', 'created_at', 'updated_at'];
    protected $table = 'order_details';

    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function product(){
        return $this->belongsTo(Products::class,'product_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
