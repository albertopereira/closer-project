<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity;
use Auth;
use Redirect;

class EntityController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


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
       return view('entities.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'organization_name' => 'required',
            'organization_email' => 'sometimes|nullable|email',
            'organization_url' => 'sometimes|nullable|url',
            'agency_email' => 'sometimes|nullable|email',
            'agency_url' => 'sometimes|nullable|url'
        ]);

        $entity = Entity::create(
            [
                'organization_name' => $request->organization_name,
                'organization_url' => $request->organization_url,
                'organization_email' => $request->organization_email,
                'agency_name' => $request->agency_name,
                'agency_url' => $request->agency_url,
                'agency_email' => $request->agency_email,
                'country' => $request->country,
                'state' => $request->state,
                'user_id' => Auth::user()->id
            ]
        );

        return redirect('home/' . $entity->id)
            ->with([
                'status' => 'Entity added with success.'
            ]);
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
        $entity = Entity::findOrFail($id);

        if(Auth::user()->id != $entity->user_id){
            return view('error')->withErrors(['You don\'t have permissions to access this resource.']);
        }

        return view('entities.edit', compact('entity'))->with('create', 0);
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
        $request->validate([
            'organization_name' => 'required',
            'organization_email' => 'sometimes|nullable|email',
            'organization_url' => 'sometimes|nullable|url',
            'agency_email' => 'sometimes|nullable|email',
            'agency_url' => 'sometimes|nullable|url'
        ]);

        $entity = Entity::findOrFail($id);

        if(Auth::user()->id != $entity->user_id){
            return view('error')->withErrors(['You don\'t have permissions to access this resource.']);
        }

        $entity->update(
            [
                'organization_name' => $request->organization_name,
                'organization_url' => $request->organization_url,
                'organization_email' => $request->organization_email,
                'agency_name' => $request->agency_name,
                'agency_url' => $request->agency_url,
                'agency_email' => $request->agency_email,
                'country' => $request->country,
                'state' => $request->state,
                'user_id' => Auth::user()->id
            ]
        );

        return redirect('home/' . $entity->id)
            ->with([
                'status' => 'Entity edited with success.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entity = Entity::findOrFail($id);

        $entity->delete();

        return redirect('home')->with([
            'status' => 'Entity removed with success.'
        ]);
    }
}
