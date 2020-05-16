<?php

namespace App\Http\Controllers\Admin\Product\Brand;

use App\Models\Product\MfdCountry;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Session;
use Image;
use Storage;
use Purifier;
use File;

class MfdCountryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'mfdCountry']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = MfdCountry::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.brand.country.index')->with('countries', $countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.brand.country.create');
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
            'name' => 'required|min:1|max:255',
            'iso_code2' => 'required|min:2|max:2|unique:mfd_countries,iso_code2',
            'iso_code3' => 'required|min:3|max:3|unique:mfd_countries,iso_code3',
            'numeric' => 'required|min:3|max:999|numeric|unique:mfd_countries,numeric',
        ]);

        if ($validator->passes()) {
            $country = new MfdCountry;
            $country->name = $request->name;
            $country->iso_code2 = $request->iso_code2;
            $country->iso_code3 = $request->iso_code3;
            $country->numeric = $request->numeric;
            
            $country->save();
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
        $country = MfdCountry::find($id);
        return view('admin.product.brand.country.edit')->with('country', $country);
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
            'name' => 'required|min:1|max:255',
            'iso_code2' => "required|min:2|max:2|unique:mfd_countries,iso_code2,$id",
            'iso_code3' => "required|min:3|max:3|unique:mfd_countries,iso_code3,$id",
            'numeric' => "required|min:3|max:999|numeric|unique:mfd_countries,numeric,$id",
        ]);

        if ($validator->passes()) {
            $country = MfdCountry::find($id);
            $country->name = $request->name;
            $country->iso_code2 = $request->iso_code2;
            $country->iso_code3 = $request->iso_code3;
            $country->numeric = $request->numeric;

            $country->save();
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
        $country = MfdCountry::find($id);
        $country->delete();
        Session::flash('success', 'The entry was successfully deleted.');
        return redirect()->back(); 
    }
}
