<?php

namespace App\Http\Controllers\Admin\Product\Attribute;

use App\Models\Product\Attribute\ProductAttributeImage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Session;

class ProductAttributeImageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'productAttributeImageSettings']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = ProductAttributeImage::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.attributes.attribute.value.image.index')->with('settings', $settings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.attributes.attribute.value.image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3|max:255',
                'code' => 'required|alpha_dash|min:3|max:255|unique:product_attribute_images,code',
                'height' => 'required',
                'width' => 'required',
            ]
        );

        if ($validator->passes()) {
            $setting = new ProductAttributeImage;
            $setting->name = $request->name;
            $setting->code = $request->code;
            $setting->height = $request->height;
            $setting->width = $request->width;
            $setting->save();
        
            Session::flash('success', 'The data was successfully inserted.');
            return redirect()->back();
        } else {
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
        $setting = ProductAttributeImage::find($id);
        return view('admin.product.attributes.attribute.value.image.edit')->with('setting', $setting);
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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3|max:255',
                'code' => "required|alpha_dash|min:3|max:255|unique:product_attribute_images,code, $id",
                'height' => 'required',
                'width' => 'required',
            ]
        );

        if ($validator->passes()) {
            $setting = ProductAttributeImage::find($id);
            $setting->name = $request->name;
            $setting->code = $request->code;
            $setting->height = $request->height;
            $setting->width = $request->width;
            $setting->save();

            Session::flash('success', 'The data was successfully updated.');
            return redirect()->back();
        } else {
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
        $setting = ProductAttributeImage::find($id);
        $setting->delete();
        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->back();
    }
}
