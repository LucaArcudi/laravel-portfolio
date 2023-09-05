<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * return guests projects index view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $projects = Project::paginate(5);
        return view('guest.projects.index', compact('projects'));
    }
}
