<?php

namespace App\Http\Controllers\Admin\Product\Attribute;

use App\Models\Product\ProductAttributeValue;
use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductAttributeSet;

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

class AttributeValueController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'productAttributeValue']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = ProductAttributeValue::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.attributes.attribute.value.index')->with('values', $values);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributeSets = ProductAttributeSet::all();
        return view('admin.product.attributes.attribute.value.create')->with('attributeSets', $attributeSets);
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
            'attribute' => 'required',
            'value' => 'required|min:2|max:255',
            'description' => 'required',
            'price' => 'regex:/^\d+(\.\d{1,2})?$/',
            'd_image' =>   'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'd_drawing' =>   'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'c_image' =>   'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
        ],
        [
            'attribute.required' => 'Please select a product attribute.',
            'frontend_type.required' => 'Please select a front end display type.',
        ]);

        if ($validator->passes()) {
            $value = new ProductAttributeValue;
            $value->product_attribute_id = $request->attribute;
            $value->value = $request->value;
            $value->price = $request->price;
            $value->value = $request->value;
            $value->description = $request->description;

            if ($request-> hasFile('d_image')) //Check if the file exists
            {
                $image = $request->file('d_image'); //Grab and store the file on to $image
                $filename = 'd_image-'.Str::slug(pathinfo($request->d_image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/attributes/'. $filename);
                Image::make($image)->resize(200, 200)->save($location); //Use intervention to create an image model and store the file with the resize.
                $value->d_image= $filename; //store the filename in to the database.
            }
            if ($request-> hasFile('d_drawing')) //Check if the file exists
            {
                $image = $request->file('d_drawing'); //Grab and store the file on to $image
                $filename = 'd_drawing-'.Str::slug(pathinfo($request->d_drawing->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/attributes/'. $filename);
                Image::make($image)->resize(200, 200)->save($location); //Use intervention to create an image model and store the file with the resize.
                $value->d_drawing= $filename; //store the filename in to the database.
            }
            if ($request->hasFile('c_image'))
            {
                $image = $request->file('c_image'); //Grab and store the file on to $image
                $filename = 'c_image-'.Str::slug(pathinfo($request->c_image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/attributes/'. $filename);
                Image::make($image)->resize(200, 200)->save($location); //Use intervention to create an image model and store the file with the resize.
                $value->c_image= $filename; //store the filename in to the database.
            }

            $value->save();
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
        $attributeSets = ProductAttributeSet::all();
        $value = ProductAttributeValue::find($id);
        return view('admin.product.attributes.attribute.value.edit')->with('attributeSets', $attributeSets)->with('value', $value);
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
            'attribute' => 'required',
            'value' => 'required|min:2|max:255',
            'description' => 'required',
            'price' => 'regex:/^\d+(\.\d{1,2})?$/',
            'd_image' =>   'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'd_drawing' =>   'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'c_image' =>   'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
        ],
        [
            'attribute.required' => 'Please select a product attribute.',
            'frontend_type.required' => 'Please select a front end display type.',
        ]);

        if ($validator->passes()) {
            $value = ProductAttributeValue::find($id);
            $value->product_attribute_id = $request->attribute;
            $value->value = $request->value;
            $value->price = $request->price;
            $value->value = $request->value;
            $value->description = $request->description;

            if ($request-> hasFile('d_image')) //Check if the file exists
            {
                $image = $request->file('d_image'); //Grab and store the file on to $image
                $filename = 'd_image-'.Str::slug(pathinfo($request->d_image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/attributes/'. $filename);
                Image::make($image)->resize(200, 200)->save($location); //Use intervention to create an image model and store the file with the resize.
                

                $oldFilename = $value->d_image;
                $value->d_image= $filename; //store the filename in to the database.
                Storage::delete('product/attributes/'. $oldFilename);
            }
            if ($request-> hasFile('d_drawing')) //Check if the file exists
            {
                $image = $request->file('d_drawing'); //Grab and store the file on to $image
                $filename = 'd_drawing-'.Str::slug(pathinfo($request->d_drawing->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/attributes/'. $filename);
                Image::make($image)->resize(200, 200)->save($location); //Use intervention to create an image model and store the file with the resize.
                
                $oldFilename = $value->d_drawing;
                $value->d_drawing= $filename; //store the filename in to the database.
                Storage::delete('product/attributes/'. $oldFilename);
            }
            if ($request-> hasFile('c_image')) //Check if the file exists
            {
                $image = $request->file('c_image'); //Grab and store the file on to $image
                $filename = 'c_image-'.Str::slug(pathinfo($request->c_image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/attributes/'. $filename);
                Image::make($image)->resize(200, 200)->save($location); //Use intervention to create an image model and store the file with the resize.
                
                $oldFilename = $value->c_image;
                $value->c_image= $filename; //store the filename in to the database.
                Storage::delete('product/attributes/'. $oldFilename);
            }

            $value->save();
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
        $value = ProductAttributeValue::find($id);
        if($value->d_image)
        {
            Storage::delete('product/attributes/'. $value->d_image);
        }
        if($value->d_drawing)
        {
            Storage::delete('product/attributes/'. $value->d_drawing);
        }
        if($value->c_image)
        {
            Storage::delete('product/attributes/'. $value->c_image);
        }

        $value->delete();

        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->back();
    }
}
