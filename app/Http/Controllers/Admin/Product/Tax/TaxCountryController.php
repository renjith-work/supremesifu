<?php

namespace App\Http\Controllers\Admin\Product\Tax;

use App\Models\Product\Tax\TaxCountry;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Session;
use Purifier;

class TaxCountryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'taxCountry']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = TaxCountry::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.tax.country.index')->with('countries', $countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.tax.country.create');
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
            'iso_code2' => 'required|min:2|max:2|unique:tax_countries,iso_code2',
            'iso_code3' => 'required|min:3|max:3|unique:tax_countries,iso_code3',
            'numeric' => 'required|min:3|max:999|numeric|unique:tax_countries,numeric',
        ]);

        if ($validator->passes()) {
            $country = new TaxCountry;
            $country->name = $request->name;
            $country->iso_code2 = $request->iso_code2;
            $country->iso_code3 = $request->iso_code3;
            $country->numeric = $request->numeric;
            $country->status = $request->status;

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
        $country = TaxCountry::find($id);
        return view('admin.product.tax.country.edit')->with('country', $country);
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
            'iso_code2' => "required|min:2|max:2|unique:tax_countries,iso_code2,$id",
            'iso_code3' => "required|min:3|max:3|unique:tax_countries,iso_code3,$id",
            'numeric' => "required|min:3|max:999|numeric|unique:tax_countries,numeric,$id",
        ]);

        if ($validator->passes()) {
            $country = TaxCountry::find($id);
            $country->name = $request->name;
            $country->iso_code2 = $request->iso_code2;
            $country->iso_code3 = $request->iso_code3;
            $country->numeric = $request->numeric;
            $country->status = $request->status;

            $country->save();
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
        $country = TaxCountry::find($id);
        $country->delete();
        Session::flash('success', 'The entry was successfully deleted.');
        return redirect()->back();
    }
}
