<?php

namespace App\Http\Controllers;
use App\Level;
use Illuminate\Http\Request;

class LevelsController extends Controller
{

    public function validateData(){
        return [
            'name' => 'required',
            'description' => 'required',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $columns = ['name', 'description', 'prerequisite_id'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        
        $query = Level::select('*')
        ->orderByRaw('LENGTH('.($column ? $columns[$column] : 'name').') ' . $dir)
        ->orderBy(($column ? $columns[$column] : 'name'), $dir)->with('prerequisite');

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('description', 'like', '%' . $searchValue . '%')
                ->orWhere('prerequisite_id', 'like', '%' . $searchValue . '%');
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
        return Level::create($request->all());
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $data = request()->validate($this->validateData());

        $data = Level::find($id);

        $data->name = $request->name;
        $data->description = $request->description;
        $data->registration = $request->registration;
        $data->tuition = $request->tuition;
        $data->insurance = $request->insurance;
        $data->library = $request->library;
        $data->science = $request->science;
        $data->computer = $request->computer;
        $data->athletics = $request->athletics;
        $data->misc = $request->misc;
        $data->books = $request->books;
        $data->school_uniform = $request->school_uniform;
        $data->pe_uniform = $request->pe_uniform;

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
        return Level::find($id)->delete();
    }

    public function levelsHome(){
        return view('admin/levels');
    }
    
    public function fetch(){
        return Level::
        orderByRaw('LENGTH(name) asc')
        ->orderBy('name', 'asc')
        ->get();
    }
}
