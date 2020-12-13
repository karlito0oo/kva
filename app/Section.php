<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    
    public function levels()
    {
        return $this->hasOne('App\Level', 'id', 'level_id');
    }

    
    public function enrolledStudents()
    {
        return $this->hasMany('App\Enrollment', 'section_id', 'id');
    }
}
