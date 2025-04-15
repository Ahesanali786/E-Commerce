<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $fillable = ['name', 'email', 'city', 'age', 'hobbies', 'gender', 'stander', 'image', 'created_at', 'updated_at'];
}
