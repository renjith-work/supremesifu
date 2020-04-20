<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product\CustomProductCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Session;
use Purifier;

class CustomProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'customProductCategory']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CustomProductCategory::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.customProduct.customProductCategory.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.customProduct.customProductCategory.create');
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
                'name' => 'required',
                'description' => 'required',
            ]
        );

        if ($validator->passes()) {
            $category = new CustomProductCategory;
            $category->name = $request->name;
            $category->description = Purifier::clean($request->description);
            $category->save();
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
        $category = CustomProductCategory::find($id);
        return view('admin.product.customProduct.customProductCategory.edit')->with('category', $category);
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
                'name' => 'required',
                'description' => 'required',
            ]
        );

        if ($validator->passes()) {
            $category = CustomProductCategory::find($id);
            $category->name = $request->name;
            $category->description = Purifier::clean($request->description);
            $category->save();
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
        $category = CustomProductCategory::find($id);
        $category->delete();
        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->back();
    }
}
