<?php

namespace App\Http\Controllers\Admin\Product\Fabric;

use App\Models\Product\Fabric\FabricAttribute;
use App\Models\Product\Fabric\FabricAttributeValue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FabricAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = FabricAttribute::all();
        return response()->json($attributes);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

    public function list()
    {
        $attributes = FabricAttribute::orderBy('id', 'asc')->get();
        $attrvalues = FabricAttributeValue::orderBy('id', 'asc')->get();

        foreach($attributes as $attribute){
            foreach($attrvalues as $value){
                if($value->fabric_attribute_id == $attribute->id){
                    $data2[] = array(
                        'id' => $value->id,
                        'value' => $value->value,
                    );
                }
            }
            $data[] = array(
                        'id' => $attribute->id,
                        'name' => $attribute->name,
                        'frontend_type' => $attribute->frontend_type,
                        'values' => $data2
                    );
            unset($data2);
        }
        return response()->json($data);
    }
}
