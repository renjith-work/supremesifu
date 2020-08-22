<?php

namespace App\Http\Controllers\Front\Api\Product\Fabric;

use App\Models\Product\Fabric\Fabric;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use Carbon\Carbon;

class FabricController extends Controller
{
    public function detail(Request $request)
    {
        $attr = $request->attr;
        $fabric = Fabric::find($request->id);
        $fabricAttributeValue_array = array();
        $data = array();

        $fabricAttributes = $fabric->fabricAttributeValues;

        // $attributeValue = new stdClass();
        // $attributeValue->name = "Name";
        // $attributeValue->value = $fabric->name;
        // $fabricAttributeValue_array[] = $attributeValue;

        foreach ($fabricAttributes as $fabricAttribute) {
            $attributeValue = new stdClass();
            $attributeValue->name = $fabricAttribute->fabricAttribute->name;
            $attributeValue->value = $fabricAttribute->value;
            $fabricAttributeValue_array[] = $attributeValue;
        }

        $fabricPrice = $this->price($fabric, $attr);
        $data = new stdClass();
        $data->id = $fabric->id;
        $data->name = $fabric->name;
        $data->class = $fabric->class->name;
        $data->image = $fabric->image;
        $data->attributes = $fabricAttributeValue_array;
        $data->price = $fabricPrice;

        return response()->json($data);
    }

    public function details()
    {
        $attr = 1;
        $fabric = Fabric::find(2);
        

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

        $test_price = $this->price($fabric, $attr);

        $data[] = array(
            'id' => $fabric->id,
            'name' => $fabric->name,
            'class' => $fabric->class->name,
            'image' => $fabric->image,
            'attributes' => $fabricAttributeValue_array,
            'price' => $fabricPrice_array,
            'test_price' => $test_price,
        );

        return response()->json($data);
    }

    private function price($fabric, $attr)
    {
        foreach($fabric->prices as $price)
        {
            if($price->product_attribute_set_id == $attr)
            {
                $startDate = Carbon::create($price->startDate);
                $endDate = Carbon::create($price->endDate);
                $fabric_price = new stdClass();
                if (Carbon::now()->between($startDate, $endDate)) {
                    $fabric_price->price = $price->splPrice;
                    $fabric_price->old_price = $price->price;
                } else {
                    $fabric_price->price = $price->price;
                    $fabric_price->old_price = null;
                }
            }
        }
        return $fabric_price;

    }
}
