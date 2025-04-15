<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['name','image','price','	description','sub_category_id','created_at', 'updated_at'];
    protected $table = 'products';


    public function subCategory(){
        return $this->belongsTo(Sub_Category::class,'sub_category_id', 'id');
    }
    public function cart(){
        return  $this->hasOne(Cart::class);
    }

    public function attribute(){
        return $this->hasMany(Atribute::class,'product_id');
    }

    public function atributevalue(){
        return $this->hasMany(atributevalue::class,'id','product_id');
    }
    public function orderDetails(){
        return $this->hasOne(OrderDetails::class,'id','product_id');
    }
}
