<?php

namespace App\Http\Controllers;

use App\Section;
use App\Setting;
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
        $columns = ['level_id', 'code', 'description'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Section::select('*')->with('levels')->orderBy($columns[$column], $dir);

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
        
        $schoolyear_id = Setting::find(1)->schoolyear_id;
        return Section::select('*')
            ->with('enrolledStudents')
            ->where('schoolyear_id', $schoolyear_id)
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

    
    
    public function fetch(Request $request){

        $schoolyear_id = Setting::find(1)->schoolyear_id;
        dd($request->Level);
        return Section::select('*')
            ->with('enrolledStudents')
            ->where('schoolyear_id', $schoolyear_id)
            ->get();
    }
}
