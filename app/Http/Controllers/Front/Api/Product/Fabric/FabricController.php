<?php

namespace App\Http\Controllers\Front\Api\Product\Fabric;

use App\Models\Product\Fabric\Fabric;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FabricController extends Controller
{
    public function detail(Request $request)
    {
        $attr = $request->attr;
        $fabric = Fabric::find($request->id);
        $fabricAttributeValue_array = array();
        $data = array();

        $fabricAttributes = $fabric->fabricAttributeValues;

        foreach ($fabricAttributes as $fabricAttribute) {
            $fabricAttributeValue_array[] = array(
                'attribute_name' => $fabricAttribute->fabricAttribute->name,
                'attribute_value' => $fabricAttribute->value,
            );
        }

        $fabricPrices = $fabric->prices;
        $fabricPrice_array = array();
        foreach ($fabricPrices as $fabricPrice) {
            if ($fabricPrice->product_attribute_set_id == $attr) {
                $fabricPrice_array[] = array(
                    'price' => $fabricPrice->splPrice,
                    'old_price' => $fabricPrice->price,
                );
            }
        }

        $data[] = array(
            'id' => $fabric->id,
            'name' => $fabric->name,
            'class' => $fabric->class->name,
            'image' => $fabric->image,
            'attributes' => $fabricAttributeValue_array,
            'price' => $fabricPrice_array,
        );

        return response()->json($data);
    }

    public function details()
    {
        $attr = 1;
        $fabric = Fabric::find(1);
        $fabricAttributeValue_array = array();
        $data = array();

        $fabricAttributes = $fabric->fabricAttributeValues;

        foreach ($fabricAttributes as $fabricAttribute) {
            $fabricAttributeValue_array[] = array(
                'attribute_name' => $fabricAttribute->fabricAttribute->name,
                'attribute_value' => $fabricAttribute->value,
            );
        }

        $fabricPrices = $fabric->prices;
        $fabricPrice_array = array();
        foreach($fabricPrices as $fabricPrice)
        {
            if($fabricPrice->product_attribute_set_id == $attr)
            {
                $fabricPrice_array[] = array(
                                    'price' => $fabricPrice->splPrice,
                                    'old_price' => $fabricPrice->price,
                );
            }
        }

        $data[] = array(
            'id' => $fabric->id,
            'name' => $fabric->name,
            'class' => $fabric->class->name,
            'image' => $fabric->image,
            'attributes' => $fabricAttributeValue_array,
            'price' => $fabricPrice_array,
        );

        return response()->json($data);
    }
}
