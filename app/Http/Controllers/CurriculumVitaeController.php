<?php

namespace App\Http\Controllers;

use App\Models\CurriculumVitae;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CurriculumVitaeController extends Controller
{
    public function create(){
        $checkCV = CurriculumVitae::where('id_researcher', auth()->user()->id)->first();

        if($checkCV){
            Alert::toast("CV already exists", 'error');
            return back();
        }

        return view('pages/cv/create');
    }

    public function store(Request $request) {
        $checkCV = CurriculumVitae::where('id_researcher', auth()->user()->id)->first();

        if(!$checkCV){
            $validatedData = $request->validate([
                'id_researcher' => 'required|unique:curriculum_vitaes,id_researcher',
                'education' => 'nullable',
                'skill' => 'nullable',
                'teaching' => 'nullable',
                'organizational' => 'nullable',
                'award' => 'nullable',
                'topic' => 'nullable',
                'publications' => 'nullable',
            ]);

            CurriculumVitae::create($validatedData);

            Alert::toast('Successfully added CV', 'success');
            return redirect('/profile');
        }else{
            Alert::toast("CV already exists", 'error');
            return back();
        }
    }

    public function edit($id){
        $cvData = CurriculumVitae::where('id_researcher', $id)->first();

        return view('pages/cv/edit', ['cvData' => $cvData]);
    }

    public function update(Request $request, $id){
  
        $validatedData = $request->validate([
                'id_researcher' => 'required|unique:curriculum_vitaes,id_researcher,'.$id.',id',
                'education' => 'nullable',
                'skill' => 'nullable',
                'teaching' => 'nullable',
                'organizational' => 'nullable',
                'award' => 'nullable',
                'topic' => 'nullable',
                'publications' => 'nullable',
        ]);
        $userData = CurriculumVitae::where('id_researcher', $id)->first();
        $userData->update($validatedData);
        Alert::toast("CV updated successfully", 'success');
        return redirect('/profile');
    }
}
