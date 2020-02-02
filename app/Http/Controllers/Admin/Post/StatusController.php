<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post\PostStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Auth;
use Validator;
use Session;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = PostStatus::orderBy('id', 'asc')->paginate(15);
        return view('admin.post.status.index')->with('statuses', $statuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.status.create');
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
            'name' => 'required|min:5|max:255|unique:post_statuses,name',
        ]);

        if ($validator->passes()) {
            $status = new PostStatus;
            $status->name = $request->name;
            $status->save();

            Session::flash('success', 'The data was successfully inserted.');
            return redirect()->route('admin.post.status.create');
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
        $status = PostStatus::find($id);
        return view('admin.post.status.edit')->with('status', $status);
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
            'name' => "required|min:5|max:255|unique:post_statuses,name, $id",
        ]);

        if ($validator->passes()) {
            $status = PostStatus::find($id);
            $status->name = $request->name;
            $status->save();

            Session::flash('success', 'The data was successfully updated.');
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
        //
    }

    public function delete($id)
    {
        $status = PostStatus::find($id);
        $status->delete();

        Session::flash('success', 'The data was successfully updated.');
        return redirect()->back();
    }
}
