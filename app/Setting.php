<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function schoolYear()
    {
        return $this->hasOne('App\SchoolYear', 'id', 'schoolyear_id');
    }
}
