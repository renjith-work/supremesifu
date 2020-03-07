<?php

namespace App\Http\Controllers\Front\Product;

use App\Models\Product\ProductAttributeValue;
use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductAttributeValueSave;
use App\Models\Product\Product;
use App\Models\Product\ProductDesign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    public function list(){
    	$data = ProductAttributeValue::where('product_attribute_id', 4)->get();
    	return response()->json($data);
    }

    public function shirtPocket(Request $request){
    	$product = $request->id;
    	$attributes = ProductAttributeValue::where('product_attribute_id', 4)->get();
    	$product_attribute = ProductAttributeValueSave::where('product_id', $product)->first();
    	$data = array();
    	foreach ($attributes as $attribute) {
    		if($attribute->id == $product_attribute->product_attribute_value_id){
    			$data[] = array(
    						'id' => $attribute->id,
    						'name' => $attribute->value,
    						'select' => 1,
    			);
    		}else{
    			$data[] = array(
    						'id' => $attribute->id,
    						'name' => $attribute->value,
    						'select' => 0,
    			);
    		}
    	}
    	return response()->json($data);
    }

    public function loadAttributes(Request $request){
        $id = $request->id;
        $product = Product::find($id);
        $category_id = $product->product_category_id;
        $attributes = ProductAttribute::where('product_category_id', $category_id)->get();
        return response()->json($attributes);
    }

    public function loadPDesignAttributes(Request $request){
        $id = $request->id;
        $product = ProductDesign::find($id);
        $category_id = $product->product_category_id;
        $attributes = ProductAttribute::where('product_category_id', $category_id)->get();
        return response()->json($attributes);
    }
}
