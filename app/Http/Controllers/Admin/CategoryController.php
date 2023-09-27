<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $data['slug'] = Str::slug($data['name'].'-'.rand());
        $newCategory = new Category();
        $newCategory->fill($data);
        $newCategory->save();

        return redirect()->route('admin.categories.index');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('message', "$category->name has been permanently removed")->with('alert-type', 'warning');
    }
}
