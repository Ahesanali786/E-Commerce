<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['name', 'user_id', 'phone_no ','state ','pincode ','city ','house_no ','landmark ','area ','created_at', 'updated_at'];
    protected $table = 'addresses';

    public function user(){
        return $this->belongsTo(user::class,'user_id','id');
    }
}
