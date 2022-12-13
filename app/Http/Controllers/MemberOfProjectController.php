<?php

namespace App\Http\Controllers;

use App\Models\MemberOfProject;
use App\Models\Project;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MemberOfProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_student' => 'required|unique:member_of_projects,id_student',
            'id_project' => 'required',
        ]);

        $validatedData['status'] = 'Pending';
        MemberOfProject::create($validatedData);

        Alert::toast('Join request has been sent', 'success');
        return back();
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
}
