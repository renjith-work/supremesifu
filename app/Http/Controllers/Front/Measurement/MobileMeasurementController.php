<?php

namespace App\Http\Controllers\Front\Measurement;

use App\Models\Product\Product;
use App\Models\Measurement\MeasurementAttribute;
use App\Models\Measurement\UserMeasurementProfile;
use App\Models\Measurement\UserMeasurementProfileValue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Cart;

class MobileMeasurementController extends Controller
{
    public function saveMeasurement(Request $request)
    {	
    	$input = $request->all();

    	$inp_mp = UserMeasurementProfile::find($input['measurement_profile']); //Get the measurement profile based on the input profile.
        $inp_mp_id = $inp_mp->id; 	//Get the id of the measurement profile
        $ms_profile =  $this->loadMeasurements($inp_mp_id, $input); //Get the profile id to be saved in product table
        
        $product = Product::find($input['product']); //Find the product.
        $product->u_mp_id = $ms_profile; //Save the measurement profile in the product table.
        $product->save(); 

        return redirect("/design/confirm/$product->id");
    }

    public function loadMeasurements($inp_mp_id, $input){
        
        $inp_mp_values = UserMeasurementProfileValue::where('u_mp_id', $inp_mp_id)->get(); //Get all the values of the measurement profile.
        
        $code_array = array();
        foreach ($inp_mp_values as $value) {
            if($value->value !=  $input[$value->measurementAttribute->code]) //Check if the measurement profile value matches the input value
            $code_array[] = array(
                            'code' => $value->measurementAttribute->code, //If value doesn't match store the value on to the code array.
            );
        }

        if(empty($code_array)){
            return $inp_mp_id; //If the values provided matches the saved profile then return the original profile id as the profile.
        }else{ //If the code array is not empty, that is the values don't match the saved profile. 
            $um_p = new UserMeasurementProfile; //Create new measurement profile.
            $um_p->user_id = Auth::user()->id;;
            $um_p->product_category_id = 3; //Set the category id as 3 default. 
            $um_p->save();

            $ma_array =[];
            $m_attributes = MeasurementAttribute::where('product_category_id', 3)->get();
            foreach($m_attributes as $m_attribute){
                if (array_key_exists($m_attribute->code, $input)) {
                    if (isset($input[$m_attribute->code])) {
                        $ma_array[] = array(
                                            'u_mp_id'       => $um_p->id,
                                            'm_at_id' => $m_attribute->id,
                                            'value' => $input[$m_attribute->code],
                        );
                    } 
                }
            }

            UserMeasurementProfileValue::insert($ma_array);
            return $um_p->id;
        }
    }
}
