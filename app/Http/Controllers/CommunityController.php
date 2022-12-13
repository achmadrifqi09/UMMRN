<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\Community;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MemberOfCommunity;
use RealRashid\SweetAlert\Facades\Alert;

class CommunityController extends Controller
{
     public function index(){
        $datas = new stdClass();
        $isEmpty = false;

        if(str_contains(auth()->user()->role, 'Researcher')){ 
            $datas = Community::where('id_researcher', auth()->user()->id)->get();
            
        }else{
            $datas = MemberOfCommunity::with('community')->get();
        }
        if($datas->isEmpty()){
            $isEmpty = true;
        }

        return view('pages/communities/index', ['datas' => $datas, 'isEmpty' => $isEmpty]);
    }

    public function create(){
        return view('pages/communities/create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'id_researcher' => 'required',
            'description' => 'required',
            'image' => 'max:1024|image|mimes:jpeg,png,jpg'
        ]);
        $validatedData['excerpt'] = Str::words($validatedData['name'], 12);
        if($request->file('image')){
            $path = $request->file('image')->store('/public/comunity-pictures');
            $storagePath = substr($path, 7);
            $validatedData['image'] = $storagePath;
        }

        Community::create($validatedData);

        Alert::toast('Comminity has been created', 'success');
        return redirect('/communities');
    }

    public function show($id){
        $community = Community::find($id);
        $members = MemberOfCommunity::where('id_community', $id)->with(['student'])->get();

        return view('pages/communities/show', ['community' => $community, 'members' => $members]);
    }

    public function approval(Request $request){

        $validatedData = $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $member =  MemberOfCommunity::find($validatedData['id']);
        
        $member->update(['status' => $validatedData['status']]);

      
         Alert::toast('The approval status has been updated', 'success');
        return back();
    }

    public function manage($id){
        $members = MemberOfCommunity::where('id_community', $id)->with(['student'])->get();
        $community = Community::find($id);
        return view('pages/communities/manage', ['community' => $community, 'members' => $members]);
    }

    public function join(Request $request) {

        $checkUser = MemberOfCommunity::where('id_student', $request->id_student)
        ->where('id_community', $request->id_project)->get();

        $validatedData = $request->validate([
            'id_student' => 'required',
            'id_community' => 'required',
        ]);

        if(!$checkUser->isEmpty()){
            Alert::toast('You are already registered with this community', 'error');
            return back();
        }

        $validatedData['status'] = 'Pending';
        MemberOfCommunity::create($validatedData);

        Alert::toast('Join request has been sent', 'success');
        return back();
    }
}
