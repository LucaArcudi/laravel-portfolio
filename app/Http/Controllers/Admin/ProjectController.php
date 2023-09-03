<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{

    public $validationRule = [
        'title' => ['required', 'min:2', 'max:50', 'unique:projects'],
        'technologies' => ['required', 'min:2', 'max:50'],
        'description' => ['required', 'min:5'],
        'date' => ['required']
    ];

    ////////////////////////////////////////////////////////////////////////////////////
    ////// CRUD METHODS START ////// CRUD METHODS START ////// CRUD METHODS START //////
    ////////////////////////////////////////////////////////////////////////////////////

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validationRule);
        $data['slug'] = Str::slug($data['title']);

        $project = new Project();
        $project->fill($data);
        $project->save();

        return redirect()->route('admin.projects.show', $project)->with('message', "$project->title has been created")->with('alert-type', 'primary');
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validationRule['title'] = ['required', 'min:2', 'max:50', Rule::unique('projects')->ignore($project->id)];
        $data = $request->validate($this->validationRule);
        $data['slug'] = Str::slug($data['title']);
        $project->update($data);

        return redirect()->route('admin.projects.show', $project->id)->with('message', "Successfully modified")->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "$project->title has been deleted")->with('alert-type', 'danger');
    }

    //////////////////////////////////////////////////////////////////////////////
    ////// CRUD METHODS END ////// CRUD METHODS END ////// CRUD METHODS END //////
    //////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// PREV & NEXT METHODS START ////// PREV & NEXT METHODS START ////// PREV & NEXT METHODS START //////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * go to the previous project
     *
     * @return \Illuminate\Http\Response
     */
    public function getPrevProject(Project $project)
    {
        $prevProject = Project::where('id', '<' ,$project->id)->orderBy('id', 'desc')->first();
        if (!is_null($prevProject)) {
            return redirect()->route('admin.projects.show', $prevProject);
        }
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * go to the next project
     *
     * @return \Illuminate\Http\Response
     */
    public function getNextProject(Project $project)
    {
        $nextProject = Project::where('id', '>' ,$project->id)->first();
        if (!is_null($nextProject)) {
            return redirect()->route('admin.projects.show', $nextProject);
        }
        return redirect()->route('admin.projects.show', $project);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ////// PREV & NEXT METHODS END ////// PREV & NEXT METHODS END ////// PREV & NEXT METHODS END //////
    ///////////////////////////////////////////////////////////////////////////////////////////////////
}