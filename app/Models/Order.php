<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'user_id','address_id','payment_method','created_at', 'updated_at'];
    protected $table = 'orders';

    public function user(){
        return $this->belongsTo(user::class,'user_id','id');
    }

    public function orderDetails(){
        return $this->hasOne(OrderDetails::class,'id','order_id');
    }
}
