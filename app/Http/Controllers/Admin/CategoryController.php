<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
       // $image = $request->file('image')->store('/public/categories');
      //  $image = $request->file('image')->store('/public/categories');
        Category::create([
            'name'        => $request->name,
            'image'       => $this->storeImage($request),
            'description' => $request->description
        ]);
        return to_route('admin.categories.index')->with('success', 'Category has been created successfully.');
    }

    private function storeImage($request)
    {
        $newImageName = uniqid(). '-'.$request->name
         .'.'. $request->image->extension();

        $image =$request->image->move(public_path('images/categories'), $newImageName);
        return $newImageName;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,Category $category)
    {
        $request->validate([
            'name'  =>'required',
            'description' => 'required'
        ]);
        $image = $category->image;
        if($request->hasFile('image')){
            $image = public_path("images/categories/$category->image");
            unlink($image);
            //Storage::delete("public/images/$image");
            $image = $this->storeImage($request);
        }
        $category->update([
            'name'        => $request->name,
            'image'       => $image,
            'description' => $request->description
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Category has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $image = public_path("images/categories/$category->image");
        unlink($image);
        $category->menus()->detach();
        // $category->menus()->delete();
        $category->delete();
        return redirect()->route('admin.categories.index')->with('danger', 'Category has been deleted successfully! ');

    }
}
