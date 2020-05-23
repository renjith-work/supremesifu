<?php

namespace App\Http\Controllers\Admin\Product\Inventory;

use App\Models\Product\Inventory\InventoryUnit;
use App\Models\Product\Inventory\InventoryUnitType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Session;
use Purifier;

class InventoryUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'inventoryUnit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = InventoryUnit::orderBy('id', 'asc')->paginate(15);
        return view('admin.product.inventory.unit.index')->with('units', $units);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = InventoryUnitType::all(); 
        return view('admin.product.inventory.unit.create')->with('types', $types);
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
            'name' => 'required|min:2|max:255',
            'abbrevation' => 'required|min:1|max:255|unique:inventory_units,abbrevation',
            'description' => 'required',
            'type' => 'required'
        ]);

        if ($validator->passes()) {
            $unit = new InventoryUnit;
            $unit->name = $request->name;
            $unit->abbrevation = $request->abbrevation;
            $unit->type_id = $request->type;
            $unit->description = $request->description;
            $unit->status = $request->status;

            $unit->save();
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
        $types = InventoryUnitType::all();
        $unit = InventoryUnit::find($id);
        return view('admin.product.inventory.unit.edit')->with('types', $types)->with('unit', $unit);
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
            'name' => 'required|min:2|max:255',
            'abbrevation' => "required|min:1|max:255|unique:inventory_units,abbrevation, $id",
            'description' => 'required',
            'type' => 'required'
        ]);

        if ($validator->passes()) {
            $unit = InventoryUnit::find($id);
            $unit->name = $request->name;
            $unit->abbrevation = $request->abbrevation;
            $unit->type_id = $request->type;
            $unit->description = $request->description;
            $unit->status = $request->status;

            $unit->save();
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
        $unit = InventoryUnit::find($id);
        $unit->delete();
        Session::flash('success', 'The entry was successfully deleted.');
        return redirect()->back();
    }
}
