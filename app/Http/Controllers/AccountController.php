<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Researcher;
use Illuminate\Http\Request;
use App\Models\CurriculumVitae;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index()
    {
       
        $userID = Auth::user()->id;
        $userRole = Auth::user()->role;
       
        $userData = $this->findUser($userID, $userRole);
        $isCV = false;

        if(auth()->user()->role != 'Student'){
            $checkCV = CurriculumVitae::where('id_researcher', auth()->user()->id)->first();
            if($checkCV){
                $isCV = true;
            }
        }
        
        return view('pages/profile/index', ['userData' => $userData, 'userRole' => $userRole, 'isCV' => $isCV]);
    }


    public function changeImage(Request $request, $id, $role){
        $validator = Validator::make($request->all(), [
            'image' => 'required|max:1024|image|mimes:jpeg,png,jpg'
        ]);

        if($validator->fails($validator->errors()->has('image'))){
            Alert::toast('Failed to upload image', 'error');
            return back();
        }

        $userData= $this->findUser($id, $role);

        if($userData->image){
             Storage::delete('public/'.$userData->image);
        }

        $path = $request->file('image')->store('/public/avatar');
        $storagePath = substr($path, 7);

        $userData->update(['image' => $storagePath]);

        Alert::toast('success', 'success');
        return back();
    }

    public function edit($id, $role)
    {
        $userData = $this->findUser($id, $role);
        return view('pages/profile/edit', ['userData' => $userData]);
    }

    public function update(Request $request, $id, $role)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|regex:/(.*)@webmail\.umm\.ac\.id/i|unique:researchers,email,'.$id.',id',
        ];

        if($request->password !== null){
            $rules['password'] = 'required|min:6';
            $rules['confirm_password'] = 'required|min:6|same:password';
        }

        if($role === 'Researcher' || $role === 'Super Researcher'){
            $rules['interest'] = 'required';
        }else{
            $rules['description'] = 'nullable';
            $rules['student_id'] = 'required';
        }
  
        $validatedData = $request->validate($rules);
        if($request->password !== null){
           $validatedData['password'] = Hash::make($validatedData['password']); 
        }
           
        $userData = $this->findUser($id, $role);
        $userData->update($validatedData);

        Alert::toast('Successfully changed data profile', 'success');
        return redirect('/profile');
    }


    public function findUser($id, $role){
         if($role === 'Researcher' || $role === 'Super Researcher'){
            return Researcher::find($id);
        }else{
            return  Student::find($id);
        }
    }


}
