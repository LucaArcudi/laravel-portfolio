<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;



class SkillController extends Controller
{
    public $validationRules = [
        'name' => [ 'required', 'min:1', 'max:25', 'unique:skills', 'not_regex:/\b\s{2,}\b/'],
        'image' => ['image', 'required'],
    ];
    
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::all();
        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skill = new Skill();
        return view('admin.skills.create', compact('skill'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules);
        $data['slug'] = Str::slug($data['name']);
        $data['image'] = Storage::put('imgs/skills', $data['image']);
        $skill = new Skill();
        $skill->fill($data);
        $skill->save();
        $skill->slug = $skill->slug.'-'.$skill->id;
        $skill->update();

        return redirect()->route('admin.skills.index')->with('message', "$skill->name Successfully created")->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        $prevSkill = Skill::where('id', '<' ,$skill->id)->orderBy('id', 'desc')->first() ?? Skill::where('id', '>' ,$skill->id)->orderBy('id', 'DESC')->first();
        $nextSkill = Skill::where('id', '>' ,$skill->id)->first() ?? Skill::where('id', '<' ,$skill->id)->first();
        return view('admin.skills.show', compact('skill', 'prevSkill', 'nextSkill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        $this->validationRules['name'] = ['required', 'min:2', 'max:50', 'not_regex:/\b\s{2,}\b/', Rule::unique('skills')->ignore($skill->id)];
        $this->validationRules['image'] = ['image'];
        $data = $request->validate($this->validationRules);
        $data['slug'] = Str::slug($data['name'].'-'.$skill->id);

        if ($request->hasFile('image')) {
            if (!$skill->isImageAValidUrl()) {
                Storage::delete($skill->image);
            }
            $data['image'] = Storage::put('imgs/skills', $data['image']);
        }

        $skill->update($data);

        return redirect()->route('admin.skills.index')->with('message', "$skill->name skill has been updated")->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('message', "$skill->name has been permanently removed")->with('alert-type', 'warning');
    }
}
