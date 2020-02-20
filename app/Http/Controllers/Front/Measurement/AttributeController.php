<?php

namespace App\Http\Controllers\Front\Measurement;

use App\Models\Measurement\MeasurementAttribute;
use App\Models\Measurement\MeasurementAttributeValue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    public function list1(){
    	$data = MeasurementAttribute::where('measurement_category_id', 1)->orderBy('id', 'asc')->get();
        return response()->json($data);
    }

    public function list2(){
        $data = MeasurementAttribute::where('measurement_category_id', 2)->orderBy('id', 'asc')->get();
        return response()->json($data);
    }

    public function list(){
        $data = MeasurementAttribute::where('product_category_id', 3)->orderBy('id', 'asc')->get();
        return response()->json($data);
    }

    public function value(){
        $attributes = MeasurementAttribute::orderBy('id', 'asc')->get();
        foreach ($attributes as $attribute) {
            $id = $attribute->id;
            $values = MeasurementAttributeValue::where('measurement_attribute_id', $id)
                                       ->orderBy('id', 'asc')
                                       ->get();
            foreach($values as $value){
                $data2[] = array(
                        'name' => $value->measurementAttribute->name,
                        'value' => $value->value,
                        );
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

    public function find(Request $request){
        $code = $request->id;
        $data = MeasurementAttribute::where('code', $code)->first();
        return response()->json($data);
    }
}
