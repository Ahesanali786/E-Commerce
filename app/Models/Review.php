<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name','email','user_id','product_id','product_review','rating','created_at', 'updated_at'];
    protected $table = 'reviews';

    public function user(){
        return $this->belongsTo(User::class ,'user_id','id');
    }
    public function product(){
        return $this->belongsTo(Products::class ,'product_id','id');
    }
    public function orderDetails(){
        return $this->belongsTo(OrderDetails::class ,'orderDetails_id','id');
    }
}
