<?php

namespace App\Http\Controllers\Admin\Product\Tax;

use App\Models\Product\Tax\TaxRate;
use App\Models\Product\Tax\TaxClass;
use App\Models\Settings\Country;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;

use Auth;
use Validator;
use Session;
use Purifier;


class TaxRateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'taxRate']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rates = TaxRate::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.tax.rate.index')->with('rates', $rates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = TaxClass::all();
        $countries = Country::where('status', 1)->get();
        return view('admin.product.tax.rate.create')->with('classes', $classes)->with('countries', $countries);
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
            'class' => 'required',
            'country' => 'required',
            'zone' => 'required',
            'description' => 'required'
        ]);

        if ($validator->passes()) {
            $rate = new TaxRate;
            $rate->tax_class_id = $request->class;
            $rate->tax_zone_id = $request->zone;
            $rate->rate = $request->rate;
            $rate->description = $request->description;

            $rate->save();
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
        $classes = TaxClass::all();
        $countries = Country::where('status', 1)->get();
        $rate = TaxRate::find($id);
        return view('admin.product.tax.rate.edit')->with('classes', $classes)->with('countries', $countries)->with('rate', $rate);

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
            'class' => 'required',
            'country' => 'required',
            'zone' => 'required',
            'description' => 'required'
        ]);

        if ($validator->passes()) {
            $rate = TaxRate::find($id);
            $rate->tax_class_id = $request->class;
            $rate->tax_zone_id = $request->zone;
            $rate->rate = $request->rate;
            $rate->description = $request->description;

            $rate->save();
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
        $rate = TaxRate::find($id);
        $rate->delete();
        Session::flash('success', 'The entry was successfully deleted.');
        return redirect()->back();
    }
}
