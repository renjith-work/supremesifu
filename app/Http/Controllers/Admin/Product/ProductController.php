<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Monogram;
use App\Models\Product\ProductMonogram;
use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductAttributeValueSave;
use App\Models\Product\ProductDesign;
use App\Models\MeasurementAttribute;
use App\Models\UserMeasurementProfile;
use App\Models\UMProfileValue;

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

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       	$products = Product::orderBy('id', 'asc')->paginate(15);
       	return view('admin.product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = ProductCategory::orderBy('id', 'asc')->get();
    	$fabrics = Fabric::orderBy('id', 'asc')->get();
    	$designs = ProductDesign::orderBy('id', 'asc')->get();
        return view('admin.product.create')->with('categories', $categories)->with('fabrics', $fabrics)->with('designs', $designs);
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
            'name' => 'required|min:5|max:255|unique:products,name',
            'category' => 'required',
            'description' => 'required',
            'summary' => 'required',
            'price' => 'required',
            'og_price' => 'required',
            'p_image' =>   'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            's_image' =>   'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'album*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'metatag' => 'required',
            'metadescp' => 'required',
        ],
        [
            'p_image.max' => 'Max image upload size is 2 MB.',
            's_image.max' => 'Max image upload size is 2 MB.',
            'album.max' => 'Max image upload size is 2 MB.',
            'category.required' => 'Please select a category.',
            'product_design.required' => 'Please select a category.',
        ]);

        if ($validator->passes()) {


        	$product = new Product;
        	$product->name = $request->name;
        	$product->user_id = 1;
        	$product->slug = Str::slug($request->name, '-'); 
        	$product->product_category_id = $request->category ;
            $product->fabric_id = $request->fabric;
        	$product->description = $request->description ;
        	$product->summary = $request->summary ;
            $product->price = $request->price ;
        	$product->og_price = $request->og_price ;
        	$product->video = $request->video;
            $product->metatag = $request->metatag;
            $product->metadescp = $request->metadescp;

        	if ($request-> hasFile('p_image')) //Check if the file exists
            {
                $image = $request->file('p_image'); //Grab and store the file on to $image
                $filename = Str::slug($request->name, '-').'-'.Str::slug(pathinfo($request->p_image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/product/'. $filename);
                Image::make($image)->resize(800, 800)->save($location); //Use intervention to create an image model and store the file with the resize.
                $product->p_image= $filename; //store the filename in to the database.
            }

            if ($request-> hasFile('s_image')) //Check if the file exists
            {
                $image = $request->file('s_image'); //Grab and store the file on to $image
                $filename = Str::slug($request->name, '-').'-'.Str::slug(pathinfo($request->s_image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/product/'. $filename);
                Image::make($image)->resize(800, 800)->save($location); //Use intervention to create an image model and store the file with the resize.
                $product->s_image= $filename; //store the filename in to the database.
            }

            if ($request-> hasFile('album')) //Check if the file exists
            {
                $count = 1;
                foreach($request->only('album') as $files){
                    foreach ($files as $file) {
                        if(is_file($file)) {    // not sure this is needed
                            $filename = Str::slug($request->name, '-').'-'.$count.'-'.time(). '.'. $file->getClientOriginalExtension();
                            $location = public_path('images/product/product/'. $filename);
                            Image::make($file)->resize(800, 800)->save($location); // path to file
                            $album_array[] = $filename;
                            $product->album = json_encode($album_array);
                            $count ++;
                        }
                    }
                }
            }

            $product->save();

            $input = $request->all();
            $productAttribute_array = array();
            $attributes = ProductAttribute::where('product_category_id', $input['category'])->get();
            foreach($attributes as $attribute)
            {
                if (array_key_exists($attribute->code, $input)){
                    $productAttribute_array[] =array(
                                                
                                                'product_id' => $product->id, 
                                                'product_attribute_id' => $attribute->id, 
                                                'product_attribute_value_id' => $input[$attribute->code], 
                                            );
                }
            }
            return response()->json($productAttribute_array);

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

    public function delete($id)
    {

    }
}
