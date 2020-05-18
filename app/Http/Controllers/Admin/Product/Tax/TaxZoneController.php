<?php

namespace App\Http\Controllers\Admin\Product\Tax;

use App\Models\Product\Tax\TaxZone;
use App\Models\Product\Tax\TaxCountry;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Session;
use Purifier;

class TaxZoneController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'taxZone']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = TaxZone::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.tax.zone.index')->with('zones', $zones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = TaxCountry::all();
        return view('admin.product.tax.zone.create')->with('countries', $countries);
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
            'code' => 'required|min:2|max:255|unique:tax_zones,code'
        ]);

        if ($validator->passes()) {
            $zone = new TaxZone;
            $zone->name = $request->name;
            $zone->code = $request->code;
            $zone->tax_country_id = $request->country;
            $zone->status = $request->status;

            $zone->save();
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
        $countries = TaxCountry::all();
        $zone = TaxZone::find($id);
        return view('admin.product.tax.zone.edit')->with('countries', $countries)->with('zone', $zone);
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
            'code' => "required|min:2|max:255|unique:tax_zones,code,$id"
        ]);

        if ($validator->passes()) {
            $zone = TaxZone::find($id);
            $zone->name = $request->name;
            $zone->code = $request->code;
            $zone->tax_country_id = $request->country;
            $zone->status = $request->status;

            $zone->save();
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
        $zone = TaxZone::find($id);
        $zone->delete();
        Session::flash('success', 'The entry was successfully deleted.');
        return redirect()->back();
    }
}
