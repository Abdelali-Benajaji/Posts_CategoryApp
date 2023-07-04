<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::with('category')->get();
        return view('post.index',compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view("post.create",compact("categories"));
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
            "title"=>"required",
            "body"=>"required"
        ]);
        
        $post= new Post();
        
        if($image=$request->file('image')){
            $distinationPath="images/posts/";
            $imageProfile=date("YmdHis") . "." . $image->getClientOriginalExtension();
            $image->move($distinationPath,$imageProfile);
            $post->image=$imageProfile;
        }
        $post->title= $request->input("title");
        $post->category_id = $request->input('category_id');
        $post->body= $request->input("body");

        $post->save();



        
        return redirect()->route("post.index")->with('success',"post created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return  view('post.index',compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories=Category::all();
        return  view('post.edit',compact("post","categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            "title"=>"required",
            "body"=>"required",
            "category_id"=>"required"
        ]);

        if($image=$request->file('image')){
            $distinationPath="images/posts/";
            $imageProfile=date("YmdHis") . "." . $image->getClientOriginalExtension();
            $image->move($distinationPath,$imageProfile);
            $post->image=$imageProfile;
        }else{
            unset($post->image);
        }
        $post->title= $request->input("title");
        $post->category_id = $request->input('category_id');
        $post->body= $request->input("body");

        $post->save();

        return redirect()->route("post.index")->with("success","post updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route("post.index")->with("success","post deleted successfully");
    }
}
