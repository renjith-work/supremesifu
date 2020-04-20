<?php

namespace App\Http\Controllers\Admin\Product\Attribute;

use App\Models\Product\Catalogue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Session;
use Image;
use Storage;
use Purifier;
use File;

class CatalogueController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'catalogue']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogues = Catalogue::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.catalogue.index')->with('catalogues', $catalogues);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.catalogue.create');
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
                'name' => 'required|min:2|max:255|unique:catalogues,name',
                'description' => 'required',
            ]
        );

        if ($validator->passes()) {
            $catalogue = new Catalogue;
            $catalogue->name = $request->name;
            $catalogue->description = Purifier::clean($request->description);
            $catalogue->save();
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
        $catalogue = Catalogue::find($id);
        return view('admin.product.catalogue.edit')->with('catalogue', $catalogue);
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
                'name' => "required|min:2|max:255|unique:catalogues,name, $id",
                'description' => 'required',
            ]
        );

        if ($validator->passes()) {
            $catalogue = Catalogue::find($id);
            $catalogue->name = $request->name;
            $catalogue->description = Purifier::clean($request->description);
            $catalogue->save();
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
        $catalogue = Catalogue::find($id);
        $catalogue->delete();
        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->back();
    }
}
