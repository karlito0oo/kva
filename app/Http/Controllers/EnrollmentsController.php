<?php

namespace App\Http\Controllers;

use Auth;
use App\Enrollment;
use App\EnrolledSubject;
use App\Setting;
use App\User;
use App\Level;
use App\Section;
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
        $student = User::find($request->student_id);
        $data = request()->validate([
            'StudentType' => 'required',
            'Level' => 'required',
            'Subjects' => 'required',
        ]);
        //check requirements if new student
        if($request->StudentType != 'Old Student'){
            if($student->birthCertificate == '' || $student->goodmoral == '' || $student->reportCard == ''){
                return [
                    'result' => false,
                    'message' => 'Incomplete requirements for the student.',
                ];
            }
        }

        //check prerequisite
        if($request->StudentType == 'Old Student'){
            $level = Level::where('id', $request->Level)->with('prerequisite')->first();
            if($level->prerequisite_id){

                $prevEnroll = Enrollment::where('student_id', $student->id)
                ->where('level_id', $level->prerequisite_id)
                ->where('status', 'Enrolled')
                ->latest()
                ->first();

                if(empty($prevEnroll)){
                    return [
                        'result' => false,
                        'message' => 'No data found for pre-requisite ' . $level->prerequisite->name . ' .',
                    ];
                }

                $prevEnrolledSubj = EnrolledSubject::where('enrollment_id', $prevEnroll->id)
                    ->where('grade', 'Failed')
                    ->get();

                if(count($prevEnrolledSubj) > 2){
                    return [
                        'result' => false,
                        'message' => 'Student did not pass the pre-requisite level.',
                    ];
                }
            }
            
        }
        


        $schoolyear_id = Setting::find(1)->schoolyear_id;

        $data = new Enrollment();
        $data->schoolyear_id = $schoolyear_id;
        $data->level_id = $request->Level;
        $data->student_type = $request->StudentType;
        $data->student_id = $student->id;
        $data->status = 'Pre-Enrolled';

        $data->save();
        foreach ($request->Subjects as $subject){
            $enrolledSubject = new EnrolledSubject();
            $enrolledSubject->enrollment_id = $data->id;
            $enrolledSubject->subject_id = $subject['id'];
            $enrolledSubject->save();
        }

        return [
            'result' => true,
        ];
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
        $data->balance = $request->balance;
        $data->status = 'Pre-Enrolled';

        $data->save();
        //delete
        $del = EnrolledSubject::select('*')
            ->where('enrollment_id', $id)
            ->delete();

        
            foreach ($request->Subjects as $subject){
                $enrolledSubject = new EnrolledSubject();
                $enrolledSubject->enrollment_id = $data->id;
                $enrolledSubject->subject_id = $subject['id'];
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
        $schoolyear_id = Setting::find(1)->schoolyear_id;
        
        return Enrollment::select('*')
            ->with('EnrolledSubjects')
            ->where('schoolyear_id', $schoolyear_id)
            ->with('student')
            ->with('level')
            ->where('student_id', $request->student_id)->first();

            
    }

    public function submitEnrollment(Request $request, $id){
        $data = request()->validate([
            'Section' => 'required',
        ]);
        //check if !maxstudentsection
        if(Setting::first()->maxstudentsection <= Enrollment::where('section_id', $request->Section)->where('status', 'Enrolled')->count()){
            return [
                'result' => false,
                'message' => 'Maximum student per section exeeded.',
            ];
        }

        $data = Enrollment::find($id);
        $data->status = 'Enrolled';
        $data->balance = $request->balance;
        $data->section_id = $request->Section;
        $data->save();

        return [
            'result' => true,
        ];
    }
}
