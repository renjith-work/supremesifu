<?php

namespace App\Http\Controllers\Admin\Product\Tax;

use App\Models\Product\Tax\TaxClass;
use App\Models\Product\Tax\TaxRate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;

use Auth;
use Validator;
use Session;
use Purifier;



class TaxClassController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'taxClass']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = TaxClass::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.tax.taxClass.index')->with('classes', $classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.tax.taxClass.create');
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
                'name' => 'required|min:5|max:255|unique:tax_classes,name',
                'description' => 'required',
            ]
        );

        if ($validator->passes()) {
            $class = new TaxClass;
            $class->name = $request->name;
            $class->description = Purifier::clean($request->description);
            $class->save();
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
        $class = TaxClass::find($id);
        return view('admin.product.tax.taxClass.edit')->with('class', $class);
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
                'name' => "required|min:5|max:255|unique:tax_classes,name, $id",
                'description' => 'required',
            ]
        );

        if ($validator->passes()) {
            $class = TaxClass::find($id);
            $class->name = $request->name;
            $class->description = Purifier::clean($request->description);
            $class->save();
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
        $class = TaxClass::find($id);
        $rates = TaxRate::where('tax_class_id', $class->id)->get();
        foreach ($rates as $rate) {
            TaxRate::where('id', $rate->id)->delete();
        }
        $class->delete();
        Session::flash('success', 'This entry and the related enteries were successfully deleted.');
        return redirect()->back();
    }
}
