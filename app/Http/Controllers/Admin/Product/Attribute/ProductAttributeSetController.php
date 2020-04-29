<?php

namespace App\Http\Controllers\Admin\Product\Attribute;

use App\Models\Product\ProductAttributeSet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Session;
use Image;
use Storage;
use Purifier;
use File;

class ProductAttributeSetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'productAttributeSet']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attribute_sets = ProductAttributeSet::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.attributes.set.index')->with('attribute_sets', $attribute_sets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.attributes.set.create');
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
                'name' => 'required|min:2|max:255|unique:product_attribute_sets,name',
                'description' => 'required',
            ]
        );

        if ($validator->passes()) {
            $attribute_set = new ProductAttributeSet();
            $attribute_set->name = $request->name;
            $attribute_set->description = Purifier::clean($request->description);
            $attribute_set->save();
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
        $attribute_set = ProductAttributeSet::find($id);
        return view('admin.product.attributes.set.edit')->with('attribute_set', $attribute_set);
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
                'name' => "required|min:2|max:255|unique:product_attribute_sets,name, $id",
                'description' => 'required',
            ]
        );

        if ($validator->passes()) {
            $attribute_set = ProductAttributeSet::find($id);
            $attribute_set->name = $request->name;
            $attribute_set->description = Purifier::clean($request->description);
            $attribute_set->save();
            Session::flash('success', 'The data was successfully inserted.');
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
        $attribute_set = ProductAttributeSet::find($id);
        $attribute_set->delete();
        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->back();
    }
}
