<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'code', 'level_id'
    ];

    
    public function levels()
    {
        return $this->hasOne('App\Level', 'id', 'level_id')->withTrashed();
    }

    public function adviser()
    {
        return $this->hasOne('App\User', 'id', 'adviser_id')->withTrashed();
    }
}
