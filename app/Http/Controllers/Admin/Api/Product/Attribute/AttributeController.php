<?php

namespace App\Http\Controllers\Admin\Api\Product\Attribute;

use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductAttributeValue;
use App\Models\Product\ProductAttributeValueSave;
use App\Models\Product\Design\ProductDesignAttributeValueSave;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    public function loadAttr(Request $request)
    {
        $id = $request->id;
        $data = ProductAttribute::where('product_attribute_set_id', $id)->get();
        return response()->json($data);
    }

    public function load(Request $request)
    {	
    	$attributes = ProductAttribute::where('product_attribute_set_id', $request->id)->get();
    	$data = array();
    	$data2 = array();
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

    public function loadEdit(Request $request)
    {   
        $product_id = $request->product_id;
        $attributeSet_id = $request->attributeSet_id;
        $attributes = ProductAttribute::where('product_attribute_set_id', $attributeSet_id)->get();

        $pavs = ProductAttributeValueSave::where('product_id', $product_id)->get();
        // return response()->json($pavs);

        $data = array();
        $data2 = array();
        // $data3 = array();

        foreach($attributes as $attribute)
        {
            $values = ProductAttributeValue::where('product_attribute_id', $attribute->id)->get();

            foreach($values as $value)
            {
                foreach ($pavs as $pav) {
                    if($pav->product_attribute_value_id == $value->id)
                    {
                      $data3 =  $value->id;
                    }
                }
            }

            foreach($values as $value)
            {
                if ($value->id == $data3) {
                    $data2[] = array(
                            'attribute_value_id' => $value->id,
                            'attribute_value_name' => $value->value,
                            'select' => 1,
                            );
                }else{
                    $data2[] = array(
                            'attribute_value_id' => $value->id,
                            'attribute_value_name' => $value->value,
                            'select' => 0,
                            );
                }
            }




            $data[] = array(

                        'id' => $attribute->id,
                        'name' => $attribute->name,
                        'code' => $attribute->code,
                        'values' => $data2,
            );
            unset($data2);
            unset($data3);
        }
        return response()->json($data);
    }

    public function loadDesignEdit(Request $request)
    {
        $design_id = $request->design_id;
        $attributeSet_id = $request->attributeSet_id;
        $attributes = ProductAttribute::where('product_attribute_set_id', $attributeSet_id)->get();

        $pavs = ProductDesignAttributeValueSave::where('product_design_id', $design_id)->get();
        // return response()->json($pavs);

        $data = array();
        $data2 = array();
        // $data3 = array();

        foreach ($attributes as $attribute) {
            $values = ProductAttributeValue::where('product_attribute_id', $attribute->id)->get();

            foreach ($values as $value) {
                foreach ($pavs as $pav) {
                    if ($pav->product_attribute_value_id == $value->id) {
                        $data3 =  $value->id;
                    }
                }
            }

            foreach ($values as $value) {
                if ($value->id == $data3) {
                    $data2[] = array(
                        'attribute_value_id' => $value->id,
                        'attribute_value_name' => $value->value,
                        'select' => 1,
                    );
                } else {
                    $data2[] = array(
                        'attribute_value_id' => $value->id,
                        'attribute_value_name' => $value->value,
                        'select' => 0,
                    );
                }
            }




            $data[] = array(

                'id' => $attribute->id,
                'name' => $attribute->name,
                'code' => $attribute->code,
                'values' => $data2,
            );
            unset($data2);
            unset($data3);
        }
        return response()->json($data);
    }

}
