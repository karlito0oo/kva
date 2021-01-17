<?php

namespace App\Http\Controllers;
use App\Adviser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdvisersController extends Controller
{
    
    public function validateData(){
        return [
            'name' => 'required',
            'lname' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'email' => 'email',
            'contactno' => 'required',
            'password' => 'required',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $columns = ['name', 'middlename', 'lname', 'gender', 'birthday', 'email', 'contactno'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        
        $query = User::select('*')->orderBy(($column ? $columns[$column] : 'lname'), $dir)->where('role_id', '4');

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

        $user = new User();
        $user->name = $request->name;
        $user->middlename = $request->middlename;
        $user->lname = $request->lname;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->contactno = $request->contactno;
        $user->email = $request->email;
        $user->role_id = '4';
        $user->password = Hash::make($request->password);

        return $user->save();
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

        $user = User::find($id);

        $user->name = $request->name;
        $user->middlename = $request->middlename;
        $user->lname = $request->lname;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->contactno = $request->contactno;
        $user->email = $request->email;

        return $user->save();
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

    public function adviserHome(){
        return view('admin/advisers');
    }
}
