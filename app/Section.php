<?php

namespace App;

use App\Subject;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    
    protected $appends = ['subjects'];
    
    public function levels()
    {
        return $this->hasOne('App\Level', 'id', 'level_id');
    }

    
    public function enrolledStudents()
    {
        return $this->hasMany('App\Enrollment', 'section_id', 'id');
    }

    public function getSubjectsAttribute(){
        return Subject::where('level_id', $this->level_id)->with('adviser')
            ->get();
    }
}
