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
        'title' => ['required', 'min:3', 'max:255', 'unique:projects'],
        'description' => ['required', 'min:5', 'max:1000'],
        'image' => ['image', 'required'],
        'is_visible' => ['boolean']
    ];

    public $errorMessages = [
        'title.required' => 'Il titolo è necessario',
        'title.min' => 'Il titolo deve essere lungo almeno 3 caratteri',
        'title.max' => 'il titolo deve essere lungo massimo 255 caratteri',
        'title.unique' => 'Esiste un altro progetto con lo stesso titolo',
        'description.required' => 'La descrizione è obbligatoria',
        'description.min' => 'La descrizione deve essere lunga almeno 5 caratteri',
        'description.max' => 'La descrizione deve essere lunga massino 1000 caratteri',
        'image.required' => 'L\'immagine è obbligatoria',
        'image.image' => 'L\'immagine deve essere un\'immagina valida',

    ];

    ////////////////////////////////////////////////////////////////////////////////////
    ////// CRUD METHODS START ////// CRUD METHODS START ////// CRUD METHODS START //////
    ////////////////////////////////////////////////////////////////////////////////////

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $projects = Project::paginate(5);
        $trash = Project::onlyTrashed()->count();
        return view('admin.projects.index', compact('projects', 'trash'));
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
        $data = $request->validate($this->validationRule, $this->errorMessages);
        $data['slug'] = Str::slug($data['title']);
        $data['image'] = Storage::put('imgs', $data['image']);
        $project = new Project();
        $project->fill($data);
        $project->save();

        return redirect()->route('admin.projects.show', $project)->with('message', "Successfully created")->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $prevProject = Project::where('id', '<' ,$project->id)->orderBy('id', 'desc')->first() ?? Project::where('id', '>' ,$project->id)->orderBy('id', 'DESC')->first();
        $nextProject = Project::where('id', '>' ,$project->id)->first() ?? Project::where('id', '<' ,$project->id)->first();
        $trash = Project::onlyTrashed()->count();
        return view('admin.projects.show', compact('project', 'nextProject', 'prevProject', 'trash'));
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
        $data = $request->validate($this->validationRule, $this->errorMessages);
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            if (!$project->isImageAValidUrl()) {
                Storage::delete($project->image);
            }
            $data['image'] = Storage::put('imgs', $data['image']);
        }

        if (!array_key_exists('is_visible', $data)) {
            $data['is_visible'] = false;
        }

        $project->update($data);

        return redirect()->route('admin.projects.show', $project)->with('message', "Successfully modified")->with('alert-type', 'success');
    }

    /**
     * Move the specified resource in the trash (soft deleting).
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Request $request)
    {   
        $data = $request->all();
        $project->delete();
        $data['routeName'];
        if ($data['routeName'] === 'admin.projects.index') {
            return redirect()->route('admin.projects.index')->with('message', "Moved to bin")->with('alert-type', 'warning');
        } else {
            $nextProject = Project::where('id', '>' ,$project->id)->first() ?? Project::where('id', '<' ,$project->id)->first();
            return redirect()->route('admin.projects.show', $nextProject)->with('message', "$project->title has been moved to bin")->with('alert-type', 'warning');
        }
    }

    //////////////////////////////////////////////////////////////////////////////
    ////// CRUD METHODS END ////// CRUD METHODS END ////// CRUD METHODS END //////
    //////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ////// TRASH BIN METHODS START ////// TRASH BIN METHODS START ////// TRASH BIN METHODS START //////
    ///////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Display the resource's trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash() 
    {
        $projects = Project::onlyTrashed()->paginate(5);
        return view('admin.projects.trash', compact('projects'));
    }

    /**
     * Restore the specified project.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($slug)
    {   
        Project::withTrashed()->where('slug', $slug)->restore();
        if (Project::onlyTrashed()->count() > 0) {
            return redirect()->back()->with('message', "Successfully restored")->with('alert-type', 'success');
        }
        return redirect()->route('admin.projects.index')->with('message', "Successfully restored")->with('alert-type', 'success');
    }

    /**
     * Remove the specified project from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($slug)
    {
        $projects = Project::withTrashed()->where('slug', $slug)->get();
        foreach($projects as $project) {
            if (!$project->isImageAValidUrl()) {
                Storage::delete($project->image);
            }
            $project->forceDelete();
        }
        if (Project::onlyTrashed()->count() > 0) {
            return redirect()->back()->with('message', "Permanently removed")->with('alert-type', 'error');
        }
        return redirect()->route('admin.projects.index')->with('message', "Permanently removed")->with('alert-type', 'error');
    }

    /**
     * Restore all projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll ()
    {
        Project::onlyTrashed()->restore();
        return redirect()->route('admin.projects.index')->with('message', "All projects successfully restored")->with('alert-type', 'success');
    }

    /////////////////////////////////////////////////////////////////////////////////////////////
    ////// TRASH BIN METHODS END ////// TRASH BIN METHODS END ////// TRASH BIN METHODS END //////
    /////////////////////////////////////////////////////////////////////////////////////////////

    public function visibilityToggle(Project $project)
    {
        $project->is_visible = !$project->is_visible;
        $project->save();
        $projectVisibility = $project->is_visible ? 'visible' : 'invisible';
        return redirect()->back()->with('message', "$project->title is $projectVisibility")->with('alert-type', 'success');
    } 
}