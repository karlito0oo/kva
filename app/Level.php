<?php

namespace App;

use App\Level;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'name', 'description', 'prerequisite_id',
    ];

    
    
    public function prerequisite()
    {
        return $this->hasOne('App\Level', 'id', 'prerequisite_id');
    }
}
