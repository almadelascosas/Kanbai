<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Projects;

use Illuminate\Http\Request;

class ProfileBusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = User::with('roles')->with('permissions')->find(auth()->user()->id);
        $projects = Projects::with('timeline')->where('user_request_id',auth()->user()->id)->get();
        return view ('site.business.index', compact('user','projects'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function myinformation(){
        $user = User::with('roles')->with('permissions')->find(auth()->user()->id);
        $projects = Projects::with('timeline')->where('user_request_id',auth()->user()->id)->get();
        return view ('site.business.myinformation', compact('user','projects'));
    }
    public function myprojects(){
        $user = User::with('roles')->with('permissions')->find(auth()->user()->id);
        $projects = Projects::with('timeline')->where('user_request_id',auth()->user()->id)->get();
        return view ('site.business.myprojects', compact('user','projects'));
    }
}
