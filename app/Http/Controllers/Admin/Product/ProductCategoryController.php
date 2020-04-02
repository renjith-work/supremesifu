<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product\ProductCategory;

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

class ProductCategoryController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'productCategory']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = ProductCategory::all();
        return view('admin.product.category.create')->with('parents', $parents);
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
            'name' => 'required|min:5|max:255|unique:product_categories,name',
            'description' => 'required',
            'image' =>   'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'metatag' => 'required',
            'metadescp' => 'required',
        ],
        [
            'metatag.required' => 'Please provide a few meta tags.',
            'metadescp.required' => 'Please provide a meta description for the category.'
        ]);

        if ($validator->passes()) {
            $category = new ProductCategory;
            $category->name = $request->name ;
            $category->slug = Str::slug($request->name, '-'); 
            $category->description = Purifier::clean($request->description) ;
            $category->featured = $request->featured ;
            $category->menu = $request->menu ;
            $category->is_filterable = $request->is_filterable ;
            if(empty($request->parent))
            {
                $category->parent_id = 1;
            }else{
                $category->parent_id = $request->parent;
            }
            $category->metatag = $request->metatag ;
            $category->metadescp = $request->metadescp ;

            if ($request-> hasFile('image')) //Check if the file exists
            {
                $image = $request->file('image'); //Grab and store the file on to $image
                $filename = Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/category/'. $filename);
                Image::make($image)->resize(835, 470)->save($location); //Use intervention to create an image model and store the file with the resize.
                $category->image= $filename; //store the filename in to the database.
            }
            $category->save();
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
        $category = ProductCategory::find($id);
        $parents = ProductCategory::all();
        return view('admin.product.category.edit')->with('parents', $parents)->with('category', $category);
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
            'name' => "required|min:5|max:255|unique:product_categories,name, $id",
            'description' => 'required',
            'image' =>   'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'metatag' => 'required',
            'metadescp' => 'required',
        ],
        [
            'metatag.required' => 'Please provide a few meta tags.',
            'metadescp.required' => 'Please provide a meta description for the category.'
        ]);

        if ($validator->passes()) {
            $category = ProductCategory::find($id);
            $category->name = $request->name ;
            $category->slug = Str::slug($request->name, '-'); 
            $category->description = Purifier::clean($request->description) ;
            $category->featured = $request->featured ;
            $category->menu = $request->menu ;
            $category->is_filterable = $request->is_filterable ;
            if(empty($request->parent))
            {
                $category->parent_id = 1;
            }else{
                $category->parent_id = $request->parent;
            }
            $category->metatag = $request->metatag ;
            $category->metadescp = $request->metadescp ;

            if ($request-> hasFile('image')) //Check if the file exists
            {
                $image = $request->file('image'); //Grab and store the file on to $image
                $filename = Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/category/'. $filename);
                Image::make($image)->resize(835, 470)->save($location); //Use intervention to create an image model and store the file with the resize.
                
                $oldFilename = $category->image;
                $category->image= $filename; //store the filename in to the database.
                Storage::delete('product/category/'. $oldFilename);
            }
            $category->save();
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
        $category = ProductCategory::find($id);
        Storage::delete('product/category/'. $category->image);
        $category->delete();
        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->back();
    }
}
