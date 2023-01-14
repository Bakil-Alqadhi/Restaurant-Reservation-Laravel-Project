<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'))->with('success', 'Menu has been created successfully.');;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuStoreRequest $request)
    {
       $menu = Menu::create([
            'name' => $request->name,
            'image' => $this->storeImage($request),
            'description' => $request->description,
            'price' => $request->price
        ]);
        if($request->has('categories')){
            $menu->categories()->attach($request->categories);
        }
        return to_route('admin.menus.index');
    }
    private function storeImage($request)
    {
        $newImageName = uniqid(). '-'.$request->name
        .'.'. $request->image->extension();
        $image =$request->image->move(public_path('images/menus/'), $newImageName);
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
    public function edit(Menu $menu)
    {
        return view('admin.menus.edit',
            [
                'menu' => $menu,
                'categories' => Category::all()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {

        $request->validate([
            'name'  =>'required',
            'description' => 'required',
            'price' => 'required'
        ]);
        $image = $menu->image;
        if($request->hasFile('image')){
            $image = public_path("images/menus/$menu->image");
            unlink($image);
            //Storage::delete("public/images/$image");
            $image = $this->storeImage($request);
        }
        $menu->update([
            'name'        => $request->name,
            'image'       => $image,
            'description' => $request->description,
            'price' => $request->price
        ]);
        if($request->has('categories')){
            $menu->categories()->sync($request->categories);
        }
        return redirect()->route('admin.menus.index')->with('success', 'Menu has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $image = public_path("images/menus/$menu->image");
        unlink($image);
        $menu->categories()->detach();
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('danger', 'Menu has been deleted successfully! ');
    }
}