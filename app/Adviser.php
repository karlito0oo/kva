<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adviser extends Model
{
    protected $fillable = [
        'firstName', 'lastName', 'email', 'mobileNumber', 'gender', 'birthday'
    ];
}
