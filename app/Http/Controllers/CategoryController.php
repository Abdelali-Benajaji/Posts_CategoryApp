<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::all();
        return view('category.index',compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "image"=>"required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "name"=>"required"
        ]);

        $category=new Category();

        if($image = $request->file("image")){
            $destinationPath='images/categories/';
            $profileImage= date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath,$profileImage);
            $category->image=$profileImage;

        }
        $category->name= $request->input("name");
        $category->save();
        

        return redirect()->route('category.index')->with("success","category created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show',compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::findOrFail($id);
        return view('category.edit', compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            "name"=>"required"
        ]);
        
        if($image = $request->file("image")){
            $destinationPath='images/categories/';
            $profileImage= date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath,$profileImage);
            $category->image=$profileImage;

        }else{
            unset($category->image);
        }
        $category->name= $request->input('name');

        $category->save();

        

        return redirect()->route('category.index')->with("success","category updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with("success","category deleted successfully");


    }
}
