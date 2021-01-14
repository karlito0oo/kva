<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name', 'description', 'code', 'level_id'
    ];

    
    public function levels()
    {
        return $this->hasOne('App\Level', 'id', 'level_id');
    }

    public function adviser()
    {
        return $this->hasOne('App\User', 'id', 'adviser_id');
    }
}
