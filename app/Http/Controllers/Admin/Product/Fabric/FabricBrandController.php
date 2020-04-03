<?php

namespace App\Http\Controllers\Admin\Product\Fabric;

use App\Models\Product\Fabric\FabricBrand;
use App\Models\Status;

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

class FabricBrandController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'FabricBrand']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = FabricBrand::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.fabric.brand.index')->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $statuses = Status::all();
        return view('admin.product.fabric.brand.create')->with('statuses', $statuses);
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
            'name' => 'required|min:2|max:255|unique:fabric_brands,name',
            'description' => 'required',
            'image' =>   'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000',
        ]);

        if ($validator->passes()) {
            $brand = new FabricBrand;
            $brand->name = $request->name;
            $brand->slug = Str::slug($request->name, '-'); 
            $brand->description = strip_tags(htmlspecialchars_decode($request->description));
            $brand->status_id = $request->status;

            if ($request-> hasFile('image')) //Check if the file exists
            {
                $image = $request->file('image'); //Grab and store the file on to $image
                $filename = Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/fabric/brands/'. $filename);
                Image::make($image)->resize(400, 400)->save($location); //Use intervention to create an image model and store the file with the resize.
                $brand->image= $filename; //store the filename in to the database.
            }

            $brand->save();
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
        $brand = FabricBrand::find($id);
        $statuses = Status::all();
        return view('admin.product.fabric.brand.edit')->with('statuses', $statuses)->with('brand', $brand);
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
            'name' => "required|min:2|max:255|unique:fabric_brands,name,$id",
            'description' => 'required',
            'image' =>   'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
        ]);

        if ($validator->passes()) {
            $brand = FabricBrand::find($id);
            $brand->name = $request->name;
            $brand->slug = Str::slug($request->name, '-'); 
            $brand->description = strip_tags(htmlspecialchars_decode($request->description));
            $brand->status_id = $request->status;

            if ($request-> hasFile('image')) //Check if the file exists
            {
                $image = $request->file('image'); //Grab and store the file on to $image
                $filename = Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/fabric/brands/'. $filename);
                Image::make($image)->resize(400, 400)->save($location); //Use intervention to create an image model and store the file with the resize.
                
                $oldFilename = $brand->image;
                $brand->image= $filename; //store the filename in to the database.
                Storage::delete('product/fabric/brands' .'/'. $oldFilename);
            }

            $brand->save();
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
        //
    }

    public function delete($id)
    {
        $brand = FabricBrand::find($id);
        Storage::delete('product/fabric/brands/'. $brand->image);
        $brand->delete(); 
        Session::flash('success', 'The entry was successfully deleted.');
        return redirect()->back(); 
    }
}
