<?php

namespace App\Http\Controllers\Admin\Product\Fabric;

use App\Models\Product\Fabric\FabricClass;
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

class FabricClassController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'fabricClass']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = FabricClass::orderBy('id', 'asc')->paginate(15);
        // return response()->json($classes);
        return view('admin.product.fabric.class.index')->with('classes', $classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::all();
        return view('admin.product.fabric.class.create')->with('statuses', $statuses);
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
            'metadescp' => 'meta description'
        );

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255|unique:fabric_classes,name',
            'description' => 'required',
            'status' => 'required',
            'price' => 'required',
            'metatag' => 'required',
            'metadescp' => 'required',
            'image' =>   'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000',
        ],
        [
            'image.max' => 'Max image upload size is 2 MB.'
        ]);

        if ($validator->passes()) {
            $class = new FabricClass;
            $class->name = $request->name;
            $class->slug = Str::slug($request->name, '-');
            $class->description = $request->description;
            $class->status_id = $request->status;
            $class->price = $request->price;
            $class->metatag = $request->metatag;
            $class->metadescp = $request->metadescp;
            $class->price = $request->price;
            $class->grade = $request->grade;

            if ($request-> hasFile('image')) //Check if the file exists
            {
                $image = $request->file('image'); //Grab and store the file on to $image
                $filename = Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/fabric/class/'. $filename);
                Image::make($image)->resize(835, 470)->save($location); //Use intervention to create an image model and store the file with the resize.
                $class->image= $filename; //store the filename in to the database.
            }
            
            $class->save();
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
        $statuses = Status::all();
        $class = FabricClass::find($id);
        return view('admin.product.fabric.class.edit')->with('statuses', $statuses)->with('class', $class);
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
            'metadescp' => 'meta description'
        );

        $validator = Validator::make($request->all(), [
            'name' => "required|min:2|max:255|unique:fabric_classes,name, $id",
            'description' => 'required',
            'status' => 'required',
            'price' => 'required',
            'metatag' => 'required',
            'metadescp' => 'required',
            'image' =>   'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
        ],
        [
            'image.max' => 'Max image upload size is 2 MB.'
        ]);

        if ($validator->passes()) {
            $class = FabricClass::find($id);
            $class->name = $request->name;
            $class->slug = Str::slug($request->name, '-');
            $class->description = $request->description;
            $class->status_id = $request->status;
            $class->price = $request->price;
            $class->metatag = $request->metatag;
            $class->metadescp = $request->metadescp;
            $class->price = $request->price;
            $class->grade = $request->grade;

            if ($request-> hasFile('image')) //Check if the file exists
            {
                $image = $request->file('image'); //Grab and store the file on to $image
                $filename = Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME), '-').'-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
                $location = public_path('images/product/fabric/class/'. $filename);
                Image::make($image)->resize(835, 470)->save($location); //Use intervention to create an image model and store the file with the resize.

                $oldFilename = $class->image;
                $class->image= $filename; //store the filename in to the database.
                Storage::delete('product/fabric/class/'. $oldFilename);
            }
            
            $class->save();
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
        $class = FabricClass::find($id);
        Storage::delete('product/fabric/class/'. $class->image);
        $class->delete();
        
        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->back();
    }

    public function load()
    {
        $fabricclasses = FabricClass::all();
        return response()->json($fabricclasses);
    }
}
