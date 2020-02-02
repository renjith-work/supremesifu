<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post\PostTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Auth;
use Validator;
use Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = PostTag::orderBy('id', 'desc')->paginate(15);
        return view('admin.post.tag.index')->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255|unique:post_tags,name',
        ]);

        if ($validator->passes()) {
            $tag = new PostTag;
            $tag->name = $request->name;
            $tag->slug = Str::slug($request->name, '-');
            $tag->save();

            Session::flash('success', 'The data was successfully inserted.');
            return redirect()->route('admin.post.tag.create');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
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
        $tag = PostTag::find($id);
        return view('admin.post.tag.edit')->with('tag', $tag);
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
        $validator = Validator::make($request->all(), [
            'name' => "required|min:5|max:255|unique:post_tags,name,$id",
        ]);

        if ($validator->passes()) {
            $tag = PostTag::find($id);
            $tag->name = $request->name;
            $tag->slug = Str::slug($request->name, '-');
            $tag->save();

            Session::flash('success', 'The data was successfully inserted.');
            return redirect()->back();
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function delete($id)
    {
        $tag = PostTag::find($id);
        $tag->delete();
        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->route('admin.post.tag.index');
    }
}
