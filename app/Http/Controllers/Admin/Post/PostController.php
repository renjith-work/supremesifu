<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use App\Models\Post\PostTag;
use App\Models\Post\PostStatus;
use App\Models\Post\PostDesign;
use App\User;
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

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'asc')->paginate(15);
        return view('admin.post.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PostCategory::orderBy('id', 'asc')->get();
        $tags = PostTag::orderBy('id', 'asc')->get();
        $statuses = PostStatus::orderBy('id', 'asc')->get();
        $users = User::orderBy('id', 'asc')->get();
        $designs = PostDesign::orderBy('id', 'asc')->get();
        return view('admin.post.create')->with('categories', $categories)->with('tags', $tags)->with('statuses', $statuses)->with('users', $users)->with('designs', $designs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributeNames = array(
            'metatag' => 'meta tag',
            'metadescp' => 'meta description',     
            'bodyE' => 'Editor Body',
            'bodyH' => 'HTML Body'
        );

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:255|unique:posts,title',
            'category' => 'required',
            'tags' => 'required',
            'bodyE' => 'nullable',
            'bodyH' => 'required_without:bodyE',
            'image' =>   'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'album*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'metatag' => 'required',
            'metadescp' => 'required',
        ],
        [
            'image.max' => 'Max image upload size is 2 MB.',
            'album.max' => 'Max image upload size is 2 MB.',
            'category.required' => 'Please select a category.',
            'tags.required' => 'Please select atleast one tag.',
        ]);

        $validator->setAttributeNames($attributeNames);

        if ($validator->passes()) {
            $post = new Post;
            $post->title = $request->title;
            $post->slug = Str::slug($request->title, '-'); 
            $post->category_id = $request->category;
            if($request->user){
                $user_id = $request->user;
            }else{
                $user_id = Auth::user()->id;
            }
            $post->user_id = $user_id; 
            $post->bodyE = $request->bodyE; 
            $post->bodyH = $request->bodyH; 
            $post->metatag = $request->metatag; 
            $post->metadescp = $request->metadescp; 

            if ($request-> hasFile('image')) //Check if the file exists
            {
                $image = $request->file('image'); //Grab and store the file on to $image
                $filename = Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/post/'. $filename);
                Image::make($image)->resize(835, 470)->save($location); //Use intervention to create an image model and store the file with the resize.
                $post->image= $filename; //store the filename in to the database.
            }

            if ($request-> hasFile('album')) //Check if the file exists
            {
                $count = 1;
                foreach($request->only('album') as $files){
                    foreach ($files as $file) {
                        if(is_file($file)) {    // not sure this is needed
                            $filename = $count.'-'.time(). '.'. $file->getClientOriginalExtension();
                            $location = public_path('images/post/'. $filename);
                            Image::make($file)->resize(835, 470)->save($location); // path to file
                            $album_array[] = $filename;
                            $post->album = json_encode($album_array);
                            $count ++;
                        }
                    }
                }
            }
            
            $post->save();
            $post->tags()->sync($request->tags, false);
            Session::flash('success', 'The data was successfully inserted.');
            return redirect()->back();
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
        $post = Post::find($id);
        return view('admin.post.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = PostCategory::orderBy('id', 'asc')->get();
        $tags = PostTag::orderBy('id', 'asc')->get();
        $statuses = PostStatus::orderBy('id', 'asc')->get();
        $users = User::orderBy('id', 'asc')->get();
        $designs = PostDesign::orderBy('id', 'asc')->get();

        $selected_tags = array();
        foreach($post->tags as $tag){
            $selected_tags[] = $tag->id;
        }
        return view('admin.post.edit')->with('post', $post)->with('selected_tags', $selected_tags)->with('categories', $categories)->with('tags', $tags)->with('statuses', $statuses)->with('users', $users)->with('designs', $designs);
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
        $attributeNames = array(
            'metatag' => 'meta tag',
            'metadescp' => 'meta description',     
            'bodyE' => 'Editor Body',
            'bodyH' => 'HTML Body'
        );

        $validator = Validator::make($request->all(), [
            'title' => "required|min:5|max:255|unique:posts,title, $id",
            'category' => 'required',
            'tags' => 'required',
            'bodyE' => 'nullable',
            'bodyH' => 'required_without:bodyE',
            'image' =>   'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'album*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'metatag' => 'required',
            'metadescp' => 'required',
        ],
        [
            'image.max' => 'Max image upload size is 2 MB.',
            'album.max' => 'Max image upload size is 2 MB.',
            'category.required' => 'Please select a category.',
            'tags.required' => 'Please select atleast one tag.',
            // 'bodyH.required_without:bodyE' => '',
        ]);

        $validator->setAttributeNames($attributeNames);

        if ($validator->passes()) {
            $post = Post::find($id);
            $post->title = $request->title;
            $post->slug = Str::slug($request->title, '-'); 
            $post->category_id = $request->category;
            if($request->user){
                $user_id = $request->user;
            }else{
                $user_id = Auth::user()->id;
            }
            $post->user_id = $user_id; 
            $post->bodyE = $request->bodyE; 
            $post->bodyH = $request->bodyH; 
            $post->metatag = $request->metatag; 
            $post->metadescp = $request->metadescp; 

            if ($request-> hasFile('image')) //Check if the file exists
            {
                $image = $request->file('image'); //Grab and store the file on to $image
                $filename = Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/post/'. $filename);
                Image::make($image)->resize(835, 470)->save($location); //Use intervention to create an image model and store the file with the resize.
                
                $oldFilename = $post->image;
                $post->image= $filename; //store the filename in to the database.
                Storage::delete('post/'. $oldFilename);
            }

             if ($post->album) {
               $album_array = json_decode($post->album, true);
            }
            else{
                $album_array = [];
            }

            if ($request-> hasFile('album')) //Check if the file exists
            {
                $count = 1;
                foreach($request->only('album') as $files){
                    foreach ($files as $file) {
                        if(is_file($file)) {    // not sure this is needed
                            $filename = $count.'-'.time(). '.'. $file->getClientOriginalExtension();
                            $location = public_path('images/post/'. $filename);
                            Image::make($file)->resize(835, 470)->save($location); // path to file
                            $album_array[] = $filename;
                            $post->album = json_encode($album_array);
                            $count ++;
                        }
                    }
                }
            }
            
            $post->save();
            if(isset($request->tags)){
                $post->tags()->sync($request->tags);
            }else{
                $post->tags()->sync(array());
            }
            Session::flash('success', 'The data was successfully updated.');
            return redirect()->route('admin.post.index');
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

    public function imageDel($id, $image_id)
    {
        $post = Post::find($id);
        $images = json_decode($post->album);
        foreach($images as $image ){
            if ($image != $image_id){
                $image_array[] = $image;
            }else{
                 Storage::delete('post/'.$image);
            }
        }
        if(!empty($image_array)){
            $post->album = json_encode($image_array);
        }else{
            $post->album = json_encode (json_decode ("{}"));
        }
        
        $post->save();
        // return redirect()->back()->with;
        return redirect(url()->previous() . "#uploaded_images");
    }
}
