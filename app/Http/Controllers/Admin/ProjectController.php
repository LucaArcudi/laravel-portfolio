<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{

    public $validationRule = [
        'title' => ['required', 'min:2', 'max:50', 'unique:projects'],
        'technologies' => ['required', 'min:2', 'max:50'],
        'description' => ['required', 'min:5'],
        'date' => ['required'],
        'image' => ['image', 'required'],
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
        $projects = Project::paginate(5);
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
        $data['image'] = Storage::put('imgs', $data['image']);
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
        $prevProject = Project::where('id', '<' ,$project->id)->orderBy('id', 'desc')->first();
        $nextProject = Project::where('id', '>' ,$project->id)->first();
        return view('admin.projects.show', compact('project', 'nextProject', 'prevProject'));
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
        $this->validationRule['image'] = ['image'];
        $data = $request->validate($this->validationRule);
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            if (!$project->isImageAValidUrl()) {
                Storage::delete($project->image);
            }
            $data['image'] = Storage::put('imgs', $data['image']);
        }

        $project->update($data);

        return redirect()->route('admin.projects.show', $project)->with('message', "Successfully modified")->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if (!$project->isImageAValidUrl()) {
            Storage::delete($project->image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "$project->title has been deleted")->with('alert-type', 'danger');
    }

    //////////////////////////////////////////////////////////////////////////////
    ////// CRUD METHODS END ////// CRUD METHODS END ////// CRUD METHODS END //////
    //////////////////////////////////////////////////////////////////////////////
}