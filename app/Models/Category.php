<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','status','category_id','created_at', 'updated_at'];
    protected $table ='categorys';

    public function SubCategory(){
        return $this->hasOne(Sub_Category::class,'category_id','id');
    }
}
