<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use SoftDeletes;
    public function EnrolledSubjects()
    {
        return $this->hasmany('App\EnrolledSubject', 'enrollment_id', 'id');
    }

    
    public function student()
    {
        return $this->hasOne('App\User', 'id', 'student_id');
    }

    
    public function level()
    {
        return $this->hasOne('App\Level', 'id', 'level_id');
    }

    public function schoolyear()
    {
        return $this->hasOne('App\SchoolYear', 'id', 'schoolyear_id');
    }
}
