<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function validateData($id = null){
        $ext = '';
        if($id != null){
            $ext = ',' . $id;
        }
        return [
            'name' => 'required',
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
        $columns = ['subjects.code', 'subjects.name', 'subjects.description', 'levels.name'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Subject::select('subjects.*')->with('levels')
        ->join('levels', 'levels.id', 'subjects.level_id')
        ->orderByRaw('LENGTH('.($column ? $columns[$column] : 'name').') ' . $dir)
        ->orderBy($columns[$column] , $dir);

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
        return Subject::create($request->all());
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
        $data = request()->validate($this->validateData($id));

        $data = Subject::find($id);

        $data->code = $request->code;
        $data->level_id = $request->level_id;
        $data->name = $request->name;
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
        return Subject::find($id)->delete();
    }

    public function pageHome(){
        return view('admin/subjects');
    }
    
    public function fetch(Request $request){

        return Subject::select('subjects.*')
            ->when($request->Level, function ($query) use ($request) {
                return $query->where('level_id', $request->Level);
            })
            ->with('levels')
            ->join('levels', 'levels.id', 'subjects.level_id')
            ->orderByRaw('LENGTH(levels.name) asc')
            ->orderBy('levels.name')
            ->get();
    }
}
