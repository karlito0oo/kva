<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Section;
use App\Setting;
use App\Subject;
use App\EnrolledSubject;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    public function validateData($id = null){
        $ext = '';
        if($id != null){
            $ext = ',' . $id;
        }
        return [
            'code' => 'required',
            'description' => 'required',
            'level_id' => 'required',
            'code' => 'required|unique:subjects,code' . $ext,
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $settings = Setting::find(1);

        $columns = ['level_id', 'code', 'description'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Section::select('sections.*')->with('levels')
        //instructor
        ->when($user->role_id == '4', function ($query) use ($user, $settings) {
            $query->join('enrollments', 'enrollments.section_id', 'sections.id');
            $query->join('enrolled_subjects', 'enrolled_subjects.enrollment_id', 'enrollments.id');
            $query->join('subjects', 'subjects.id', 'enrolled_subjects.subject_id');
            $query->where('subjects.adviser_id', $user->id);
            $query->where('enrollments.schoolyear_id', $settings->schoolyear_id);
            $query->where('enrollments.status', 'Enrolled');
            $query->distinct();

            return $query;
        })
        ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue, $columns) {
                foreach(array_keys($columns) as $key){
                    $query->orWhere($columns[$key], 'like', '%' . $searchValue . '%');
                }
            });
        }

        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
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
        $data = request()->validate($this->validateData());
        
        $schoolyear_id = Setting::find(1)->schoolyear_id;

        $data = new Section();
        $data->level_id = $request->level_id;
        $data->code = $request->code;
        $data->description = $request->description;
        $data->schoolyear_id = $schoolyear_id;
        $data->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($level_id)
    {
        return Section::select('*')
            ->with('enrolledStudents')
            ->where('level_id', $level_id)
            ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
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
        $data = request()->validate($this->validateData($id));

        $data = Section::find($id);

        $data->code = $request->code;
        $data->level_id = $request->level_id;
        $data->description = $request->description;

        return $data->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Section::find($id)->delete();
    }

    public function pageHome(){
        return view('admin/sections');
    }

    
    
    public function fetch($level_id){

        return Section::select('*')
            ->with('enrolledStudents')
            ->where('schoolyear_id', $level_id)
            ->get();
    }

    public function updateAdvisers(Request $request){
        foreach ($request->subjects as $subject){
            $currentSubject = Subject::find($subject['id']);
            $currentSubject->adviser_id = $subject['adviser_id'];
            $currentSubject->save();
        }
        
        return true;
    }

    public function studentSubjects(Request $request){

        $adviser = Auth::user();
        
        return User::select('subjects.*', 'enrolled_subjects.grade', 'enrolled_subjects.id as es_id')
            ->distinct()
            ->join('enrollments', 'enrollments.student_id', 'users.id')
            ->join('enrolled_subjects', 'enrolled_subjects.enrollment_id', 'enrollments.id')
            ->join('subjects', 'subjects.id', 'enrolled_subjects.subject_id')
            ->where('subjects.adviser_id', $adviser->id)
            ->where('enrollments.section_id', $request->selectedSection['id'])
            ->where('enrollments.student_id', $request->selectedStudent['id'])
            ->get();
    }

    public function updateStudentGrade(Request $request){
        foreach ($request->selectedStudentSubject as $subject){
            $currentSubject = EnrolledSubject::find($subject['es_id']);
            $currentSubject->grade = $subject['grade'];
            $currentSubject->save();
        }
        
        return true;
    }
}
