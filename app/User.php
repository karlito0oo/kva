<?php

namespace App;

use App\Setting;
use App\User;
use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
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

    protected $appends = ['currentEnrollment'];

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
            ->get();
    }
}
