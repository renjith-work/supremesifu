<?php

namespace App\Http\Controllers\Front\Api\Product\Attribute;

use App\Models\Product\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    public function loadShirtPocket(Request $request)
    {
        $product = Product::find($request->id);
        foreach ($product->attributes as $attr) {
            if ($attr->product_attribute_id == 4) {
                $selected_pocket_value = $attr->product_attribute_value_id;
            }
        }

        $shirtPockets_array = array();
        foreach ($product->attributeSet->attributes as $attribute) {
            if ($attribute->id == 4) {
                foreach ($attribute->productAttributeValues as $value) {
                    if ($value->id == $selected_pocket_value) {
                        $shirtPockets_array[] = array(
                            'value' => $value->value,
                            'select' => 1
                        );
                    } else {
                        $shirtPockets_array[] = array(
                            'value' => $value->value,
                            'select' => 0
                        );
                    }
                }
            }
        }
        return response()->json($shirtPockets_array);
    }


    public function loadShirtPockets()
    {
        $product = Product::find(5);
        foreach($product->attributes as $attr)
        {
            if($attr->product_attribute_id == 4)
            {
                $selected_pocket_value = $attr->product_attribute_value_id;
            }
        }


        $shirtPockets_array = array();
        foreach ($product->attributeSet->attributes as $attribute)
        {
            if($attribute->id == 4)
            {
                foreach($attribute->productAttributeValues as $value)
                {
                    if($value->id == $selected_pocket_value)
                    {
                        $shirtPockets_array[] = array(
                                                'value' => $value->value,
                                                'select' => 1
                        );
                    }else{
                        $shirtPockets_array[] = array(
                                                'value' => $value->value,
                                                'select' => 0
                        );
                    }
                }   
            }  
        }
        return response()->json($shirtPockets_array);
        
    }
}
