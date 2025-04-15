<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atribute extends Model
{
    protected $fillable = ['variant_name','product_id','attributes_id ', 'created_at', 'updated_at'];
    protected $table = 'atributes';

    public function Product(){
        return $this->belongsTo(Products::class,'product_id','id');
    }

    public function values(){
        return $this->hasMany(AtributeValue::class,'attributes_id'.'id');
    }

}
