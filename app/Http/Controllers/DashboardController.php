<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index (){
        $projects = Project::orderBy('created_at', 'desc')->limit(4);
        return view('pages/client/home', ['projects' => $projects->with(['researcher'])->get(), 'isProject' => $projects->get()->isEmpty()]);
    }
}
