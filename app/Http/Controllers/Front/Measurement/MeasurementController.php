<?php

namespace App\Http\Controllers\Front\Measurement;

use App\Models\Product\Product;
use App\Models\Measurement\MeasurementAttribute;
use App\Models\Measurement\UserMeasurementProfile;
use App\Models\Measurement\UserMeasurementProfileValue;
use App\Models\Measurement\UserProductMeasurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Cart;

class MeasurementController extends Controller
{
    public function __construct() {
         $this->middleware(['auth']);
    }

    public function csuMeasurement($currentProduct, $measurementResponse)
    {
        $product = Product::find($currentProduct);
        return view('front.product.custom.completeProduct')->with('product', $product)->with('measurementResponse', $measurementResponse);
    }

    public function test()
    {
        $measurementResponse = 1;
        $product = Product::find(47);
        return view('front.product.custom.completeProduct')->with('product', $product)->with('measurementResponse', $measurementResponse);
    }

    public function saveMeasurement(Request $request)
    {	
        $input = $request->all();
        $product = Product::find($input['product']);
        $measurementResponse = $this->checkMeasurementProfile($input);
        $this->saveProductMeasurement($input);
        $this->addToCart($product);
        return view('front.product.custom.completeProduct')->with('product', $product)->with('measurementResponse', $measurementResponse);
    }

    private function addToCart($product)
    {
        Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price->price,
            'attributes' => array(
                'fabric' => $product->fabric->name,
                'user'   => $product->user_id,
                'images' => $product->design->images
            )
        ));
    }

    private function saveProductMeasurement($input)
    {
        $product_measeurement_array = array();
        $attributes = MeasurementAttribute::where('product_attribute_set_id', 1)->get();
        foreach($attributes as $attribute)
        {
            if (array_key_exists($attribute->code, $input)) 
            {
                if (isset($input[$attribute->code])) 
                {
                    $product_measeurement_array[] = array(
                                                    'ump_id' => $input['measurement_profile'],
                                                    'product_id' => $input['product'],
                                                    'm_at_id' => $attribute->id,
                                                    'value' => $input[$attribute->code]
                    );
                } 
            }
        }
        UserProductMeasurement::insert($product_measeurement_array);
        return $product_measeurement_array;
    }

    private function checkMeasurementProfile($input)
    {
        $response_value = 0;
        $profile_id = $input['measurement_profile'];
        $profile_values = UserMeasurementProfileValue::where('u_mp_id', $profile_id)->get();
        foreach($profile_values as $profile_value)
        {
            if($profile_value->value != $input[$profile_value->measurementAttribute->code])
            {
                $response_value++;
            }
        }
        return $response_value;
    }

    public function saveProfile(Request $request)
    {
        $product = Product::find($request->id);
        
        // Save User Profile
        $userProfile = new UserMeasurementProfile;
        $userProfile->user_id = Auth::user()->id;
        $userProfile->product_attribute_set_id = $product->product_attribute_set_id;
        $userProfile->name = $request->name;
        $userProfile->save();

        // Save UserProfile Values
        $measurement_array = array();
        foreach($product->measurements as $measurement)
        {
            $measurement_array[] = array(
                                    'u_mp_id' => $userProfile->id,
                                    'm_at_id' => $measurement->m_at_id,
                                    'value'   => $measurement->value,
            );
        }
        UserMeasurementProfileValue::insert($measurement_array);
        UserProductMeasurement::where('product_id', $product->id)->update(['ump_id' => $userProfile->id]);
        return response()->json($userProfile->name);
    }

    // public function loadMeasurements($inp_mp_id, $input){
    //     return $inp_mp_id;
    // }
    
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
