<?php

namespace App;

use App\Setting;
use App\User;
use App\Subject;
use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lname', 'email', 'password', 'role_id', 'image', 'middlename', 'address', 'contactno', 'birthday', 'birthplace', 'gender', 'civilStatus', 'religion', 'nationality', 'guardianName', 'guardianContactNo', 'guardianAddress'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['currentEnrollment', 'instructorSubjects'];

    public function roles(){
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function getCurrentEnrollmentAttribute(){
        $schoolyear_id = Setting::find(1)->schoolyear_id;
        return Enrollment::select('enrollments.*', 'sections.code as sectionName', 'levels.name as levelName')
            ->leftJoin('sections', 'sections.id', 'enrollments.section_id')
            ->leftJoin('levels', 'levels.id', 'enrollments.level_id')
            ->where('enrollments.schoolyear_id', $schoolyear_id)
            ->where('enrollments.student_id', $this->id)
            ->first();
    }

    public function getInstructorSubjectsAttribute(){
        return Subject::where('adviser_id', $this->id)->with('levels')->get();
    }

    public static function enrolledStudents($type = null, $id = null){
        $schoolyear_id = Setting::find(1)->schoolyear_id;
        return Enrollment::select(
            'enrollments.*', 
            'levels.name as levelName', 
            'users.name', 
            'users.middlename', 
            'users.lname', 
            'users.email', 
            'users.contactno',
            'users.guardianContactNo',
            'sections.code as sectionCode'
        )
        ->join('levels', 'levels.id', 'enrollments.level_id')
        ->join('users', 'users.id', 'enrollments.student_id')
        ->join('sections', 'sections.id', 'enrollments.section_id')
        ->where('enrollments.schoolyear_id', $schoolyear_id)
        ->where('enrollments.status', 'Enrolled')
        //get by section
        ->when($type == 'section', function ($query) use ($id) {
            $query->where('enrollments.section_id', $id);
            return $query;
        })
        //get by level
        ->when($type == 'level', function ($query) use ($id) {
            $query->where('enrollments.level_id', $id);
            return $query;
        })
        ->orderBy('levels.name')
        ->orderBy('sections.code')
        ->get();
    }

    public static function allStudents(){
        return User::select(
            'enrollments.*', 
            'levels.name as levelName', 
            'users.name', 
            'users.middlename', 
            'users.lname', 
            'users.email', 
            'users.contactno',
            'users.guardianContactNo',
            'sections.code as sectionCode'
        )
        ->leftJoin('enrollments', 'users.id', 'enrollments.student_id')
        ->leftJoin('levels', 'levels.id', 'enrollments.level_id')
        ->leftJoin('sections', 'sections.id', 'enrollments.section_id')
        ->where('users.role_id', '1')
        ->orderByRaw('ISNULL(levels.name), levels.name ASC')
        ->orderBy('sections.code')
        ->orderBy('users.lname')
        ->get();
    }

    public static function preEnrolledStudents(){
        $schoolyear_id = Setting::find(1)->schoolyear_id;
        return Enrollment::select('enrollments.*', 'levels.name as levelName')
        ->join('levels', 'levels.id', 'enrollments.level_id')
        ->where('enrollments.schoolyear_id', $schoolyear_id)
        ->where('enrollments.status', 'Pre-Enrolled')
        ->get();
    }

    public static function enrolledSubjects($enrollment_id){
        $schoolyear_id = Setting::find(1)->schoolyear_id;
        return Subject::select('subjects.*', 'users.name as fName', 'users.lname')
        ->join('enrolled_subjects', 'enrolled_subjects.subject_id', 'subjects.id')
        ->leftJoin('users', 'users.id', 'subjects.adviser_id')
        ->where('enrolled_subjects.enrollment_id', $enrollment_id)
        ->get();
    }
}
