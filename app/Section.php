<?php

namespace App;

use Auth;
use App\Subject;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    
    protected $appends = ['subjects', 'adviserStudents'];
    
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

    public function getAdviserStudentsAttribute(){
        $adviser = Auth::user();

        return User::select('users.*')
            ->distinct()
            ->join('enrollments', 'enrollments.student_id', 'users.id')
            ->join('enrolled_subjects', 'enrolled_subjects.enrollment_id', 'enrollments.id')
            ->join('subjects', 'subjects.id', 'enrolled_subjects.subject_id')
            ->where('subjects.adviser_id', $adviser->id)
            ->where('enrollments.section_id', $this->id)
            ->where('enrollments.status', 'Enrolled')
            ->get();
    }
}
