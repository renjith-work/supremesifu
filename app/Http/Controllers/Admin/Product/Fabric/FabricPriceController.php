<?php

namespace App\Http\Controllers\Admin\Product\Fabric;

use App\Models\Product\Fabric\FabricPrice;
use App\Models\Product\ProductAttributeSet;
use App\Models\Product\Fabric\Fabric;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Session;
use Redirect;

class FabricPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function createPrice($id)
    {   
        $attribute_sets = ProductAttributeSet::all();
        $fabric_id = $id;
        return view('admin.product.fabric.price.create')->with('fabric_id', $fabric_id)->with('attribute_sets', $attribute_sets);
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
                'price' => 'required',
                'startDate' => 'required_with:splPrice',
                'endDate' => 'required_with:splPrice',
            ]
        );

        if ($validator->passes()) {

            $price = new FabricPrice;
            $price->fabric_id = $request->fabric_id;
            $price->product_attribute_set_id = $request->product_set;
            $price->price = $request->price;
            $price->splPrice = $request->splPrice;
            $price->startDate = $request->startDate;
            $price->endDate = $request->endDate;
            $price->save();

            $url = '/admin/product/fabric/'.$price->fabric_id.'/edit';
            Session::flash('success', 'The data was successfully inserted.');
            return Redirect::away($url);
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
        $fabric_price = FabricPrice::find($id);
        $attribute_sets = ProductAttributeSet::all();
        $fabric_id = $fabric_price->fabric_id;
        return view('admin.product.fabric.price.edit')->with('fabric_price', $fabric_price)->with('fabric_id', $fabric_id)->with('attribute_sets', $attribute_sets);

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
                'price' => 'required',
                'startDate' => 'required_with:splPrice',
                'endDate' => 'required_with:splPrice',
            ]
        );

        if ($validator->passes()) {

            $price = FabricPrice::find($id);
            $price->fabric_id = $request->fabric_id;
            $price->product_attribute_set_id = $request->product_set;
            $price->price = $request->price;
            $price->splPrice = $request->splPrice;
            $price->startDate = $request->startDate;
            $price->endDate = $request->endDate;
            $price->save();

            $url = '/admin/product/fabric/' . $price->fabric_id . '/edit';
            Session::flash('success', 'The data was successfully updated.');
            return Redirect::away($url);
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
        $price = FabricPrice::find($id);
        $price->delete();

        $url = '/admin/product/fabric/' . $price->fabric_id . '/edit';
        Session::flash('success', 'The data was successfully updated.');
        return Redirect::away($url);
    }
}
