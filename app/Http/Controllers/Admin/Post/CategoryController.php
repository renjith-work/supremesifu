<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Auth;
use Validator;
use Session;
Use Image;
Use Storage;
Use Purifier;
use File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PostCategory::orderBy('id', 'asc')->paginate(15);
        return view('admin.post.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PostCategory::orderBy('id', 'asc')->get();
        return view('admin.post.category.create')->with('categories', $categories);
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
            'name' => 'required|min:5|max:255|unique:post_categories,name',
            'parent_id' => 'required',
            'menu' => 'required',
            'featured' => 'required',
            'description' => 'required',
            'metatag' => 'required',
            'metadescp' => 'required',
            'image' =>   'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2000',
        ],
        [
            'parent_id.required' => 'Please select a category.',
            'image.max' => 'Max image upload size is 2 MB.'
        ]);

        if ($validator->passes()) {
            $category = new PostCategory;
            $category->name = $request->name;
            $category->slug = Str::slug($request->name, '-'); 
            $category->parent_id = $request->parent_id;
            $category->description = strip_tags(htmlspecialchars_decode($request->description));
            $category->metatag = strip_tags(htmlspecialchars_decode($request->metatag));
            $category->metadescp = strip_tags(htmlspecialchars_decode($request->metadescp));
            $category->featured = $request->featured;
            $category->menu = $request->menu;

            if ($request-> hasFile('image')) //Check if the file exists
            {
                $image = $request->file('image'); //Grab and store the file on to $image
                $filename = Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/post/'. $filename);
                Image::make($image)->resize(835, 470)->save($location); //Use intervention to create an image model and store the file with the resize.
                $category->image= $filename; //store the filename in to the database.
            }

            return response()->json($category);
            $category->save();
            Session::flash('success', 'The data was successfully inserted.');
            return redirect()->route('admin.post.category.create');
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
        $category = PostCategory::find($id);
        $categories = PostCategory::orderBy('id', 'asc')->get();
        return view('admin.post.category.edit')->with('category', $category)->with('categories', $categories);
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
            'name' => "required|min:5|max:255|unique:post_categories,name, $id",
            'parent_id' => 'required',
            'menu' => 'required',
            'featured' => 'required',
            'description' => 'required',
            'metatag' => 'required',
            'metadescp' => 'required',
            'image' =>   'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2000',
        ],
        [
            'parent_id.required' => 'Please select a category.',
            'image.max' => 'Max image upload size is 2 MB.'
        ]);

        if ($validator->passes()) {
            $category = PostCategory::find($id);
            $category->name = $request->name;
            $category->slug = Str::slug($request->name, '-'); 
            $category->parent_id = $request->parent_id;
            $category->description = strip_tags(htmlspecialchars_decode($request->description));
            $category->metatag = strip_tags(htmlspecialchars_decode($request->metatag));
            $category->metadescp = strip_tags(htmlspecialchars_decode($request->metadescp));
            $category->featured = $request->featured;
            $category->menu = $request->menu;

            $exists = Storage::exists('post/'.$category->image);

            if ($request-> hasFile('image')) //Check if the file exists
            {
                $image = $request->file('image'); //Grab and store the file on to $image
                $filename = Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/post/'. $filename);
                Image::make($image)->resize(835, 470)->save($location); //Use intervention to create an image model and store the file with the resize.
                
                $oldFilename = $category->image;
                $category->image= $filename; //store the filename in to the database.
                Storage::delete('post' .'/'. $oldFilename);
            }
            $category->save();
            Session::flash('success', 'The data was successfully updated.');
            return redirect()->route('admin.post.category.index');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    // Storage::delete('/images/post/placeholder-1580198249.jpg');

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
        $category = PostCategory::find($id);
        Storage::delete('post/'. $category->image);
        $category->delete(); 
        Session::flash('success', 'The entry was successfully deleted.');
        return redirect()->route('admin.post.category.index'); 
    }
}
