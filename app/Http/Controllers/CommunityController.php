<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use stdClass;
use App\Models\Community;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MemberOfCommunity;
use App\Models\MemberOfProject;
use App\Models\Topic;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;
use RealRashid\SweetAlert\Facades\Alert;

class CommunityController extends Controller
{
     public function index(){
        $datas = new stdClass();
        if(str_contains(auth()->user()->role, 'Researcher')){
            $communities = Community::where('id_researcher', auth()->user()->id)->get();
            $datas->communities = $communities;
            $datas->isEmpty = $communities->isEmpty();
        }else{
            $members = MemberOfCommunity::where('id_student', auth()->user()->id)->pluck('id_community');
          
            $communitiesJoined = MemberOfCommunity::where('id_student', auth()->user()->id)->with('community')->get();
            $communities = Community::where(function($query) use ($members){
                foreach($members as $idCommunity){
                    $query->where('id', '!=', $idCommunity);
                }
            })->get();
    
          $datas->communitiesJoined = $communitiesJoined;
          $datas->joinedIsEmpty = $communitiesJoined->isEmpty();
          $datas->communities = $communities;
          $datas->communitiesIsEmpty = $communities->isEmpty();
            
        }
         return view('pages/communities/index', ['datas' => $datas]);
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
        $topics = Topic::where('id_community', $id)->with(['student', 'researcher'])->orderBy('created_at', 'desc')->get();
        $comments = Comment::where('id_community', $id)->with(['student', 'researcher'])->get();
        
        return view('pages/communities/show', [
            'community' => $community, 
            'members' => $members, 
            'topics' => $topics, 
            'comments' => $comments
        ]);
    }

    public function sendTopic(Request $request, $id){
        $validatedData = $request->validate([
            'message' => 'required',
            'id_researcher' => 'required',
            'id_student' => 'nullable'
        ]);

        $validatedData['id_community'] = $id;
        
        Topic::create($validatedData);
        Alert::toast('Successfully submitted topic', 'success');

        return back();

    }

    public function sendComment(Request $request, $id){
         $validatedData = $request->validate([
            'comment' => 'required',
            'id_researcher' => 'required',
            'id_student' => 'nullable',
            'id_topic' => 'required'
        ]);
        $validatedData['id_community'] = $id;

        Comment::create($validatedData);
        Alert::toast('Successfully submitted comment', 'success');

        return back();
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
        return view('pages/communities/manage', ['community' => $community, 'members' => $members, 'isEmpty' => $members->isEmpty()]);
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
