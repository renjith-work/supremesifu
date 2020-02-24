<?php

namespace App\Http\Controllers\Front\Guide;

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use App\Models\Post\PostTag;
use App\Models\Post\PostStatus;
use App\Models\Post\PostDesign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('category_id', 5)->paginate(15);
        return view('front.guide.index')->with('posts', $posts);
    }

    public function single($slug)
    {   
        $post = Post::where('slug', '=', $slug)->first();
        $categories = PostCategory::orderBy('id', 'asc')->get();
        $posts = Post::where('category_id', $post->category_id)->take(5)->orderBy('id', 'asc')->get();
        return view('front.guide.single')->with('post', $post)->with('categories', $categories)->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
