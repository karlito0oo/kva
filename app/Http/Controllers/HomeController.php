<?php

namespace App\Http\Controllers;

use Auth;
use App\Setting;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if(!$user){
            abort(404);
        }
        //get home page
        if($user->roles->name == 'Student'){
            return view('student/home', [
                'user' => $user,
                'settings' => Setting::first(),
            ]);
        }
        elseif($user->roles->name == 'Super Admin'){
            $data['schoolyear'] = (Setting::first()->schoolYear ? Setting::first()->schoolYear->name : 'Not set');
            $data['students'] = User::where('role_id', '1')->get();
            $data['enrolledStudents'] = User::enrolledStudents();
            $data['instructors'] = User::where('role_id', '4')->get();
            $data['preEnrolledStudents'] = User::preEnrolledStudents();
            $data['enrollmentDate'] = Setting::first();
            $data['enrollmentDate'] = ($data['enrollmentDate']->enrollmentStart ? date('M d', strtotime($data['enrollmentDate']->enrollmentStart)) . ' - ' . date('M d, Y', strtotime($data['enrollmentDate']->enrollmentEnd)) : 'N/A');
            return view('admin/home', [
                'user' => $user,
                'data' => $data,
                'settings' => Setting::first(),
            ]);
        }
        elseif($user->roles->name == 'Instructor'){
            $data['schoolyear'] = (Setting::first()->schoolYear ? Setting::first()->schoolYear->name : 0);
            $data['students'] = User::where('role_id', '1')->get();
            $data['enrolledStudents'] = User::enrolledStudents();
            $data['instructors'] = User::where('role_id', '4')->get();
            $data['preEnrolledStudents'] = User::preEnrolledStudents();
            $data['enrollmentDate'] = Setting::first();
            $data['enrollmentDate'] = ($data['enrollmentDate']->enrollmentStart ? date('M d', strtotime($data['enrollmentDate']->enrollmentStart)) . ' - ' . date('M d, Y', strtotime($data['enrollmentDate']->enrollmentEnd)) : 'N/A');
            return view('instructor/home', [
                'user' => $user,
                'data' => $data,
                'settings' => Setting::first(),
            ]);
        }
    }
    
    public function loggedinUser()
    {
        $user = Auth::user();
        if(!$user){
            return abort(404);
        }
        return $user;
    }
}
