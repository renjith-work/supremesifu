<?php

namespace App\Http\Controllers\Front\Measurement;

use App\Models\Measurement\MeasurementAttribute;
use App\Models\Measurement\MeasurementAttributeValue;
use App\Models\Measurement\UserMeasurementProfile;
use App\Models\Measurement\UserMeasurementProfileValue;
use App\Models\Product\Product;
use App\Models\Product\ProductDesign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeValueController extends Controller
{   
    public function findValues(Request $request){
        $profile_id = $request->id;
        $profileValues = UserMeasurementProfileValue::where('u_mp_id', $profile_id)->get();
        $data = array();
        foreach ($profileValues as $profileValue) {
            $attribute = MeasurementAttribute::where('id', $profileValue->m_at_id)->first();
            $data[] = array(
                            'value' => $profileValue->value,
                            'code' => $attribute->code,
                        ); 
        }
        return response()->json($data);
    }

    public function list(){
        $profile_id = 1;
        $profileValues = UserMeasurementProfileValue::where('u_mp_id', $profile_id)->get();
        $data = array();
        foreach ($profileValues as $profileValue) {
            $attribute = MeasurementAttribute::where('id', $profileValue->m_at_id)->first();
            $data[] = array(
                            'value' => $profileValue->value,
                            'code' => $attribute->code,
                        ); 
        }
        return response()->json($data);
    }

    public function find(Request $request){
    	$profile_id = $request->id;
    	$values = MeasurementAttributeValue::whereHas('measurementProfile', function ($query) use ($profile_id){
			    	$query->where('profile_id', '=', $profile_id);
				})->get();
    	foreach($values as $value){
    		$attributeValue = MeasurementAttributeValue::where('id', $value->id)->first();
    		$attribute =  MeasurementAttribute::where('id', $attributeValue->measurement_attribute_id)->first();
    		$data[] = array(
    						'id' => $attributeValue->id,
    						'value' => $attributeValue->value,
    						'code' => $attribute->code,
    					);

    	}
    	return response()->json($data);
    }

    public function loadValues(Request $request){
        $product = Product::find($request->id);
        $u_mp_id = $product->u_mp_id;
        $values = UserMeasurementProfileValue::where('u_mp_id', $u_mp_id)->get();
        $data = array();
        foreach($values as $value){
            $data[] = array(
                    'name' => $value->measurementAttribute->name,
                    'code' => $value->measurementAttribute->code,
                    'value' => $value->value,
            );
        }
        return response()->json($data);
    }

    public function loadAttributeValues(Request $request){
        $u_mp_id = $request->id;
        $values = UserMeasurementProfileValue::where('u_mp_id', $u_mp_id)->get();
        $data = array();
        foreach($values as $value){
            $data[] = array(
                    'name' => $value->measurementAttribute->name,
                    'code' => $value->measurementAttribute->code,
                    'value' => $value->value,
            );
        }
        return response()->json($data);
    }

    public function loadAttributeTest(){
        $u_mp_id = 2;
        $values = UserMeasurementProfileValue::where('u_mp_id', $u_mp_id)->get();
        $data = array();
        foreach($values as $value){
            $data[] = array(
                    'name' => $value->measurementAttribute->name,
                    'code' => $value->measurementAttribute->code,
                    'value' => $value->value,
            );
        }
        return response()->json($data);
    }

    public function loadAttributes(Request $request){
        $id = $request->id;
        $product = Product::find($id);
        $category_id = $product->product_category_id;
        $attributes = MeasurementAttribute::where('product_category_id', $category_id)->get();
        return response()->json($attributes);
    }

    public function loadPDesignAttributes(Request $request){
        $id = $request->id;
        $product = ProductDesign::find($id);
        $category_id = $product->product_category_id;
        $attributes = MeasurementAttribute::where('product_category_id', $category_id)->get();
        return response()->json($attributes);
    }


}
