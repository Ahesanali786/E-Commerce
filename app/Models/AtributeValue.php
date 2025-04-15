<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtributeValue extends Model
{
    protected $fillable = ['product_id', 'attributes_id', 'veriant_value', 'created_at', 'updated_at'];
    protected $table = 'atribute_values';

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function attribute()
    {
        return $this->belongsTo(Atribute::class, 'attributes_id', 'id');
    }
}
