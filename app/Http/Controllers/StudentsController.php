<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use App\Setting;
use App\Level;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function validateData(){
        return [
            'firstName' => 'required',
            'lastName' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'email' => 'email',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $columns = ['firstName', 'lastName', 'gender', 'birthday', 'email', 'mobileNumber'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Student::select('*')->orderBy(($column ? $columns[$column] : 'lname'), $dir);

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
        return Student::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        $setting = Setting::first();

        return view('admin/student-edit', [
            'user' => $user,
            'settings' => $setting,
        ]);
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
        $data = request()->validate($this->validateData());

        $data = Student::find($id);

        $data->lastName = $request->lastName;
        $data->firstName = $request->firstName;
        $data->email = $request->email;
        $data->birthday = $request->birthday;
        $data->gender = $request->gender;
        $data->mobileNumber = $request->mobileNumber;

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
        return Student::find($id)->delete();
    }

    public function studentsHome($level_id = null){
        return view('admin/students', [
            'level' => Level::find($level_id),
        ]);
    }
}
