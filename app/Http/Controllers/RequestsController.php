<?php

namespace App\Http\Controllers;
use App\Request as CredentialRequest;
use Illuminate\Http\Request;
use Auth;

class RequestsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $columns = ['type', 'status'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        
        $query = CredentialRequest::select('*')->with('users')->orderBy($columns[$column], $dir);

        $user = Auth::user();

        if($user->role_id == 1){
            $query->where('user_id', $user->id);
        }

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('type', 'like', '%' . $searchValue . '%');
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
        $user = Auth::user();

        $credentialRequest = new CredentialRequest();
        $credentialRequest->user_id = $user->id;
        $credentialRequest->type = $request->type;
        $credentialRequest->status = "pending";
        $credentialRequest->save();

        return $credentialRequest;
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

        $credentialRequest = CredentialRequest::find($id);
        $credentialRequest->status = "approved";
        $credentialRequest->save();

        return $credentialRequest;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return CredentialRequest::find($id)->delete();
    }

    public function pageHome(){
        return view('admin/requests');
    }
    
    public function fetch(){
        return CredentialRequest::
        orderBy('created_at', 'desc')
        ->get();
    }
}
