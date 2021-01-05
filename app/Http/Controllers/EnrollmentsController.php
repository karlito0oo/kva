<?php

namespace App\Http\Controllers;

use Auth;
use App\Enrollment;
use App\EnrolledSubject;
use App\Setting;
use App\User;
use Illuminate\Http\Request;

class EnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = request()->validate([
            'StudentType' => 'required',
            'Level' => 'required',
            'Subjects' => 'required',
        ]);
        $schoolyear_id = Setting::find(1)->schoolyear_id;

        $data = new Enrollment();
        $data->schoolyear_id = $schoolyear_id;
        $data->level_id = $request->Level;
        $data->student_type = $request->StudentType;
        $data->student_id = $user->id;
        $data->status = 'Pre-Enrolled';

        $data->save();

        foreach ($request->Subjects as $subject){
            $enrolledSubject = new EnrolledSubject();
            $enrolledSubject->enrollment_id = $data->id;
            $enrolledSubject->subject_id = $subject;
            $enrolledSubject->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $schoolyear_id = Setting::find(1)->schoolyear_id;

        $data = Enrollment::find($id);
        $data->schoolyear_id = $schoolyear_id;
        $data->level_id = $request->Level;
        $data->student_type = $request->StudentType;
        $data->student_id = $data->student_id;
        $data->status = 'Pre-Enrolled';

        $data->save();
        //delete
        $del = EnrolledSubject::select('*')
            ->where('enrollment_id', $id)
            ->delete();

        foreach ($request->Subjects as $subject){
            $enrolledSubject = new EnrolledSubject();
            $enrolledSubject->enrollment_id = $data->id;
            $enrolledSubject->subject_id = $subject;
            $enrolledSubject->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Enrollment::find($id)->delete();
    }

    public function pageHome(){
        return view('student/registration');
    }

    public function checkEnrollmentDetails(Request $request){
        $user = Auth::user();
        $schoolyear_id = Setting::find(1)->schoolyear_id;

        if($request->enrollment_ids){
            return Enrollment::select('*')
            ->with('EnrolledSubjects')
            ->with('student')
            ->find($request->enrollment_ids);
        }
        
        return Enrollment::select('*')
            ->with('EnrolledSubjects')
            ->where('schoolyear_id', $schoolyear_id)
            ->with('student')
            ->where('student_id', $user->id)->first();

            
    }

    public function submitEnrollment(Request $request, $id){
        $data = request()->validate([
            'Section' => 'required',
        ]);


        $data = Enrollment::find($id);
        $data->status = 'Enrolled';
        $data->section_id = $request->Section;
        $data->save();

        return true;
    }
}
