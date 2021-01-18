<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'firstName', 'lastName', 'email', 'mobileNumber', 'gender', 'birthday'
    ];
}
