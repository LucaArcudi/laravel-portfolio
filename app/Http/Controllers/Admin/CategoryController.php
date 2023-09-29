<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{   

    protected $validationRules = [
        'name' => ['required', 'unique:categories', 'min:3', 'max:25'],
        'color' => ['required', 'max:25'],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create', ['category' => new Category()]);
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
        $newCategory = new Category();
        $newCategory->fill($data);
        $newCategory->save();
        $newCategory->slug = $newCategory->slug."-$newCategory->id";
        $newCategory->update();
        return redirect()->route('admin.categories.index')->with('message', "$newCategory->name category has been created")->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $prevCategory = Category::where('id', '<' ,$category->id)->orderBy('id', 'desc')->first() ?? Category::where('id', '>' ,$category->id)->orderBy('id', 'DESC')->first();
        $nextCategory = Category::where('id', '>' ,$category->id)->first() ?? Category::where('id', '<' ,$category->id)->first();
        return view('admin.categories.show', compact('category', 'prevCategory', 'nextCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validationRules['name'] = ['required', Rule::unique('categories')->ignore($category->id), 'min:3', 'max:25'];
        $data = $request->validate($this->validationRules);
        $data['slug'] = Str::slug($data['name']."-$category->id");
        $category->update($data);
        return redirect()->route('admin.categories.index')->with('message', "$category->name category has been updated")->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete(); // set the projects category_id on null (check category_id migration onDelete method)
        $projectsWithCategoryIdOnNull = Project::where('category_id', null)->get(); // the projects with category_id null
        $noCategoryCategory = Category::where('name', 'No category')->get(); // the category "No category"
        foreach($projectsWithCategoryIdOnNull as $project) {
            $project->category_id = $noCategoryCategory[0]->id; // Iterate through projects with category_id null and assign them to the "No category" category
            $project->update();
        }
        return redirect()->route('admin.categories.index')->with('message', "$category->name has been permanently removed")->with('alert-type', 'warning');
    }
}
