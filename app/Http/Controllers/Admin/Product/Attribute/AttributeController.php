<?php

namespace App\Http\Controllers\Admin\Product\Attribute;

use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Session;
Use Image;
Use Storage;
Use Purifier;
use File;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = ProductAttribute::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.attribute.index')->with('attributes', $attributes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.product.attribute.create')->with('categories', $categories);
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
            'name' => 'required|min:5|max:255',
            'code' => 'required|min:5|max:255|unique:product_attributes,code',
            'category' => 'required',
            'frontend_type' => 'required',
            'is_filterable' => 'required',
            'is_required' => 'required',
        ],
        [
            'category.required' => 'Please select a product category.',
            'frontend_type.required' => 'Please select a front end display type.',
            'is_filterable.required' => 'Please select if you want to filter through the attributes.',
            'is_required.required' => 'Please select if you want to attribute compulsory.',
        ]);

        if ($validator->passes()) {
            $attribute = new ProductAttribute;
            $attribute->name = $request->name;
            $attribute->code = $request->code;
            $attribute->product_category_id = $request->category;
            $attribute->frontend_type = $request->frontend_type;
            $attribute->is_filterable = $request->is_filterable;
            $attribute->is_required = $request->is_required;
            $attribute->save();
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
        $attribute = ProductAttribute::find($id);
        $categories = ProductCategory::all();
        return view('admin.product.attribute.edit')->with('categories', $categories)->with('attribute', $attribute);
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
            'name' => 'required|min:5|max:255',
            'code' => "required|min:5|max:255|unique:product_attributes,code, $id",
            'category' => 'required',
            'frontend_type' => 'required',
            'is_filterable' => 'required',
            'is_required' => 'required',
        ],
        [
            'category.required' => 'Please select a product category.',
            'frontend_type.required' => 'Please select a front end display type.',
            'is_filterable.required' => 'Please select if you want to filter through the attributes.',
            'is_required.required' => 'Please select if you want to attribute compulsory.',
        ]);

        if ($validator->passes()) {
            $attribute = ProductAttribute::find($id);
            $attribute->name = $request->name;
            $attribute->code = $request->code;
            $attribute->product_category_id = $request->category;
            $attribute->frontend_type = $request->frontend_type;
            $attribute->is_filterable = $request->is_filterable;
            $attribute->is_required = $request->is_required;
            $attribute->save();
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
        $attribute = ProductAttribute::find($id);
        $attribute->delete();
        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->back();
    }
}
