<?php

namespace App\Http\Controllers\Admin\Api\Product\Attribute;

use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductAttributeValue;
use App\Models\Product\ProductAttributeValueSave;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    public function load(Request $request)
    {	
    	$attributes = ProductAttribute::where('product_category_id', $request->id)->get();
    	$data = array();
    	// $data2 = array();
    	foreach($attributes as $attribute)
    	{
    		$values = ProductAttributeValue::where('product_attribute_id', $attribute->id)->get();

    		foreach($values as $value)
    		{
    			$data2[] = array(
    						'attribute_value_id' => $value->id,
    						'attribute_value_name' => $value->value,
    			);	
    		}

    		$data[] = array(

    					'id' => $attribute->id,
    					'name' => $attribute->name,
    					'code' => $attribute->code,
    					'values' => $data2
    		);
    		unset($data2);
    	}
    	return response()->json($data);
    }
}
