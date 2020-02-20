<?php

namespace App\Http\Controllers\Front\Product\Design\Shirt;

use App\Models\Product\ProductDesign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesignController extends Controller
{
    public function listshirtDesigns($id)
 	{
 		$fabric = $id;
        $designs = ProductDesign::orderBy('id', 'asc')->get();
        $data = array(
                        'fabric' => $fabric,
                        'designs' => $designs,
                    );
        return view('front.product.custom.shirt.design.index')->with('data', $data);
 	}  

 	public function load(Request $request)
    {
    	$design = ProductDesign::find($request->id);
    	return response()->json($design);
    }
}
