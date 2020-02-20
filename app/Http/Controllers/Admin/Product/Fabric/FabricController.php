<?php

namespace App\Http\Controllers\Admin\Product\Fabric;

use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Fabric\FabricClass;
use App\Models\Product\Fabric\FabricAttribute;
use App\Models\Product\Fabric\FabricAttributeValue;
use App\Models\Product\Brand;

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

class FabricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fabrics = Fabric::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.fabric.index')->with('fabrics', $fabrics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = FabricClass::orderBy('id', 'asc')->get();
        $brands = Brand::orderBy('id', 'asc')->get();
        $attributes = FabricAttribute::orderBy('id', 'asc')->get();
        $values = FabricAttributeValue::orderBy('id', 'asc')->get();
        return view('admin.product.fabric.create')->with('brands', $brands)->with('classes', $classes)->with('attributes', $attributes)->with('values', $values);
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
            'name' => 'required|unique:fabrics,name',
            'description' => 'required',
            'price'  => 'required',
            'brand'  => 'required',
            'class'  => 'required',
            'image'  => 'required|image',
        ]);

        if($validator->passes())
        {
            $fabric = new Fabric;
            $fabric->name = $request->name;
            $fabric->slug = Str::slug($request->name, '-'); 
            $fabric->description = Purifier::clean($request->description);
            $fabric->price = $request->price;
            $fabric->fabric_class_id = $request->class;
            $fabric->brand_id = $request->brand;
            $fabric->status_id = 1;
            if ($request-> hasFile('image')) //Check if the file exists
            {
                $image = $request->file('image'); //Grab and store the file on to $image
                $filename = Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/fabric/'. $filename);
                Image::make($image)->resize(500, 400)->save($location); //Use intervention to create an image model and store the file with the resize.
                $fabric->image= $filename; //store the filename in to the database.
            }
            $fabric->save();

            $attributes = FabricAttribute::orderBy('id', 'asc')->get();
            $results = $request->all();
            foreach($results as $key => $result){
                foreach($attributes as $atr){
                    if($key == $atr->name){
                        $syncTable[] = $result;
                    }
                }
            }
            $fabric->fabricAttributeValues()->sync($syncTable);
            Session::flash('success', 'The data was successfully stored.');
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
        $classes = FabricClass::orderBy('id', 'asc')->get();
        $brands = Brand::orderBy('id', 'asc')->get();
        $attributes = FabricAttribute::orderBy('id', 'asc')->get();
        $values = FabricAttributeValue::orderBy('id', 'asc')->get();
        $fabric = Fabric::find($id);
        return view('admin.product.fabric.edit')->with('fabric', $fabric)->with('brands', $brands)->with('classes', $classes)->with('attributes', $attributes)->with('values', $values);
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
            'name' => "required|unique:fabrics,name,$id",
            'description' => 'required',
            'price'  => 'required',
            'brand'  => 'required',
            'class'  => 'required',
            'image'  => 'image',
        ]);

         if($validator->passes())
        {
            $fabric = Fabric::find($id);
            $fabric->name = $request->name;
            $fabric->slug = Str::slug($request->name, '-'); 
            $fabric->description = Purifier::clean($request->description);
            $fabric->price = $request->price;
            $fabric->fabric_class_id = $request->class;
            $fabric->brand_id = $request->brand;
            $fabric->status_id = 1;
            if ($request-> hasFile('image')) //Check if the file exists
            {
                $image = $request->file('image'); //Grab and store the file on to $image
                $filename = Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/fabric/'. $filename);
                Image::make($image)->resize(500, 400)->save($location); //Use intervention to create an image model and store the file with the resize.
                
                $oldFilename = $fabric->image;
                $fabric->image= $filename; //store the filename in to the database.
                Storage::delete('product/fabric/'.$oldFilename);
            }
            $fabric->save();

            $attributes = FabricAttribute::orderBy('id', 'asc')->get();
            $results = $request->all();
            foreach($results as $key => $result){
                foreach($attributes as $atr){
                    if($key == $atr->name){
                        $syncTable[] = $result;
                    }
                }
            }
            $fabric->fabricAttributeValues()->sync($syncTable);

            Session::flash('success', 'The data was successfully stored.');
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
        $fabric = Fabric::find($id);
        $fabric->fabricAttributeValues()->detach();
        Storage::delete('product/fabric/'.$fabric->image);
        $fabric->delete();

        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->back();
    }
}
