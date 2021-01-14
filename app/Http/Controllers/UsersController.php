<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function validateData($id){
        return [
            'name' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'contactno' => 'required|integer',
            'email' => 'required|email|unique:users,email,'.$id,
            'birthday' => 'required|date',
            'birthplace' => 'required',
            'gender' => 'required',
            'civilStatus' => 'required',
            'nationality' => 'required',
            'guardianName' => 'required',
            'guardianContactNo' => 'required|integer',
            'guardianAddress' => 'required',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $columns = ['name', 'lname', 'gender', 'birthday', 'email', 'mobileNumber'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = User::select('*')->where('role_id', '1')->orderBy($columns[$column], $dir);

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
        return User::create($request->all());
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
        $data = request()->validate($this->validateData($id));

        $data = User::find($id);

        $data->name = $request->name;
        $data->lname = $request->lname;
        $data->middleName = $request->middleName;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->contactno = $request->contactno;
        $data->birthday = $request->birthday;
        $data->birthplace = $request->birthplace;
        $data->gender = $request->gender;
        $data->civilStatus = $request->civilStatus;
        $data->religion = $request->religion;
        $data->nationality = $request->nationality;
        //guardian
        $data->guardianName = $request->guardianName;
        $data->guardianContactNo = $request->guardianContactNo;
        $data->guardianAddress = $request->guardianAddress;
        //schools
        $data->elementary = $request->elementary;
        $data->elementaryAddress = $request->elementaryAddress;
        $data->highschool = $request->highschool;
        $data->highschoolAddress = $request->highschoolAddress;

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
        return User::find($id)->delete();
    }

    public function pagesHome(){
        return view('admin/students');
    }

    public function fetchAdvisers(){
        return User::where('role_id', '4')->get();
    }
}
