<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_Category extends Model
{
    protected $fillable = ['name','status','category_id','created_at', 'updated_at'];
    protected $table ='subcategorys';

    public function Category(){
        return $this->belongsTo(Category::class,'category_id' , 'id');
    }
    public function Products(){
        return $this->hasOne(Products::class,'sub_category_id','id');
    }
}
