<?php

namespace App\Http\Controllers\Front\Product\Monogram;

use App\Models\Product\Monogram;
use App\Models\Product\ProductMonogram;
use App\Models\Product\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonogramController extends Controller
{
    public function list()
    {
        $data = Monogram::orderBy('id', 'asc')->get();
        return response()->json($data);
    }

    public function loadValues(Request $request){
    	$product_id = $request->id;
    	$values = ProductMonogram::where('product_id', $product_id)->get();
    	$data = array();
    	foreach ($values as $value) {

    		$data[] = array(
    					'id' => $value->id,
    					'code' => $value->monogram->code,
    					'value' => $value->value,
    		);
    	}
        return response()->json($data);
    }

    public function loadProductMonogram(Request $request){
        $id = $request->id;
        $product = Product::find($id);
        $category_id = $product->product_category_id;
        $monogram = Monogram::where('product_category_id', $category_id)->get();
        return response()->json($monogram);
    }


}
