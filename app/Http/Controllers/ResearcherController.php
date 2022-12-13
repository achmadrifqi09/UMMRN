<?php

namespace App\Http\Controllers;

use App\Models\CurriculumVitae;
use App\Models\Project;
use App\Models\Researcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ResearcherController extends Controller
{
    public function index()
    {   
        return view('pages/researchers/index', ['researchers' => Researcher::all()]);
    }


    public function create()
    {
        return view('pages/researchers/create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'interest' => 'required',
            'phone' => 'required',
            'email' => 'required|email|regex:/(.*)@webmail\.umm\.ac\.id/i|unique:researchers,email',
            'password' => 'required|min:6',
            'role' => 'required|in:Super Researcher,Researcher',
            'confirm_password' => 'required|min:6|same:password',
            'image' => 'max:1024|image|mimes:jpeg,png,jpg'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        if($request->file('image')){
            $path = $request->file('image')->store('/public/avatar');
            $storagePath = substr($path, 7);
            $validatedData['image'] = $storagePath;
        }
        
        Researcher::create($validatedData);
        Alert::toast('Successfully added researcher', 'success');
        return redirect('/researchers');

    }


    public function show($id)
    {
        $cv = CurriculumVitae::where('id_researcher', $id)->first();
        return view('pages/researchers/show', ['researcher' => Researcher::find($id), 'cvOfResearcher' => $cv]);
    }


    public function destroy($id)
    {
       $researcher = Researcher::find($id);

       if($researcher->image){
            Storage::delete('public/'.$researcher->image);
       }
       
       $researcher->delete();
       Project::where('id_researcher', $id)->delete();
       CurriculumVitae::where('id_researcher', $id)->delete();

       Alert::toast('Data has been deleted', 'success');
       return back();
    }
}
