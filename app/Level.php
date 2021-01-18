<?php

namespace App;

use App\Level;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'prerequisite_id',
    ];

    
    
    public function prerequisite()
    {
        return $this->hasOne('App\Level', 'id', 'prerequisite_id');
    }
}
