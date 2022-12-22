<?php

namespace App\Http\Controllers;

use App\Models\MemberOfProject;
use stdClass;
use Carbon\Carbon;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class ProjectController extends Controller
{

    public function index()
    {

      
        $userRole = auth()->user()->role;
        $projects = new stdClass();

        if($userRole == 'Researcher' || $userRole == 'Super Researcher'){
            $filteredProjects = Project::where('id_researcher', auth()->user()->id);
            $projects = $filteredProjects->with(['researcher'])->get();
        }else{
            $projects = Project::with(['researcher'])->get();
        }
        return view('pages/projects/index', ['projects' => $projects, 'total' => count($projects)]);
    }


    public function create()
    {
        $publishedYear = Carbon::now()->format('Y');
        return view('pages/projects/create', ['publishedYear' => $publishedYear]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'id_researcher' => 'required',
            'published_year' => 'required',
            'status'=> 'required',
            'description'=> 'required',
            'total_member' => 'required'
        ]);
        $validatedData['available_member'] = 0; 
        $validatedData['excerpt'] = Str::words($validatedData['title'], 4);
        if($request->file('image')){
            $path = $request->file('image')->store('/public/project-pictures');
            $storagePath = substr($path, 7);
            $validatedData['image'] = $storagePath;
        }

        Project::create($validatedData);
        Alert::toast('Project has been created', 'success');

        return redirect('/projects');
    }

    public function join(Request $request)
    {
        $checkUser = MemberOfProject::where('id_student', $request->id_student)
        ->where('id_project', $request->id_project)->get();

        $validatedData = $request->validate([
            'id_student' => 'required',
            'id_project' => 'required',
        ]);

        if(!$checkUser->isEmpty()){
            Alert::toast('You are already registered with this project', 'error');
            return back();
        }

        $project = Project::find($validatedData['id_project']);
        if($project->status == 'Complated'){
            Alert::toast('The project ended', 'error');
            return back();
        }

        $path = $request->file('portfolio')->store('/public/portfolio');
        $storagePath = substr($path, 7);
        $validatedData['portfolio'] = $storagePath;

        $validatedData['status'] = 'Pending';
        MemberOfProject::create($validatedData);

        Alert::toast('Join request has been sent', 'success');
        return back();
    }

    public function approval(Request $request){
        $validatedData = $request->validate([
            'id' => 'required',
            'status' => 'required',
            'studentId' => 'required'
        ]);
      
        $project = Project::find($validatedData['id']);

        $checkMember = MemberOfProject::where('id_project', $validatedData['id'])
                        ->where('id_student', $validatedData['studentId'])->first();
        if($project->available_member < $project->total_member && $checkMember->status !== 'Accept'){
            
            if($validatedData['status'] === 'Accept'){
                $project->update([
                    'available_member' => $project->available_member + 1,
                ]);
            }else{
                Alert::toast('Cannot change existing status', 'error');
                return back();
            }
            $checkMember->update(['status' => $validatedData['status']]);

            Alert::toast('The approval status has been updated', 'success');
            return back();
        }else if($validatedData['status'] === 'Reject' && $checkMember->status === 'Accept'){
            $project->update([
                'available_member' => $project->available_member - 1,
            ]);
            
             $checkMember->update(['status' => $validatedData['status']]);
            Alert::toast('The approval status has been updated', 'success');
            return back();
        }else{
            Alert::toast('The project member quota is full', 'error');
            return back();
        }

    }

    public function show($id)
    {
        $project = Project::where('id', $id);
        $members = new MemberOfProject();

        $data = [
            'project' => $project->with(['researcher'])->first(), 
        ];

        if(str_contains(auth()->user()->role, 'Researcher')){
            $members = MemberOfProject::where('id_project', $id)->with(['student'])->get();
            $data['members'] = $members;
            $data['isMember'] = $members->isEmpty();
            // dd($members->isEmpty());
        }else{
            $checkUser = MemberOfProject::where('id_student', auth()->user()->id)
            ->where('id_project', $id);
            if($checkUser->first()){
                $data['status'] = $checkUser->first()->status;
            }

            $data['projects'] = Project::where('id_researcher', $project->first()->id_researcher)->where('id', '!=', $id)->get();
            $data['anotherProjectIsEmpty'] = $data['projects']->isEmpty();
        }
    
        return view('pages/projects/show', $data);
    }
    public function getExcerpt($project){
        if($project->title){
            $project->title = Str::words($project->title, 6, '...');
        }
    }

    public function edit($id)
    {
        $project = Project::find($id);
        return view('pages/projects/edit', ['project' => $project]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
           'title' => 'required',
            'id_researcher' => 'required',
            'published_year' => 'required',
            'status'=> 'required',
            'description'=> 'required'
        ]);
        $project = Project::find($id);
        $validatedData['excerpt'] = Str::words($validatedData['title'], 4);
        if($request->file('image')){
            $path = $request->file('image')->store('/public/project-pictures');
            $storagePath = substr($path, 7);
            $validatedData['image'] = $storagePath;

            if($project->image){
                Storage::delete('public/'.$project->image);
            }
        }

        $project->update($validatedData);
        Alert::toast('Project has been edited', 'success');
        return redirect('/projects');
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        if($project->images){
           Storage::delete('public/'.$project->image);
        }

        $project->delete();
        $members = MemberOfProject::where('id_project', $id)->get();

        foreach($members as $member){
            if($member->portfolio){
                Storage::delete('public/'.$member->portfolio);
            }
        }
        $member->delete();
        
        Alert::toast('Project has been deleted', 'success');
        return redirect('/projects');
    }
}
