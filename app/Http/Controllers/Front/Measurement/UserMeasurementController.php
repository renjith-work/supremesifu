<?php

namespace App\Http\Controllers\Front\Measurement;

use App\Models\Measurement\UserMeasurementProfile;
use App\Models\Measurement\MeasurementAttribute;
use App\Models\Measurement\UserMeasurementProfileValue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

class UserMeasurementController extends Controller
{	
	public function __construct() {
         $this->middleware(['auth']);
    }
    
    public function storeWith(Request $request)
    {
    
        Auth::user()->id;
    	$data = array();
        $input = $request->all();
        $category_id = $input['category_id'];

        $measurement = new UserMeasurementProfile;
        $measurement->name = $input['name'];
        $measurement->user_id = Auth::user()->id;;
        $measurement->product_category_id = $category_id;
        $measurement->save();
        
        $u_mp_id = $measurement->id;
        
        $attributes = MeasurementAttribute::where('product_category_id', $category_id)->get();

        foreach($input as $key => $value){
        	foreach($attributes as $attribute){
        		if($key == $attribute->code){
        			$data[] = array(
        					'u_mp_id' => $u_mp_id,
        					'm_at_id' => $attribute->id,
        					'value' => $value,
                            'created_at'    => Carbon::now(),
                            'updated_at'    => Carbon::now()
        			);
        		}
        	}
        }
        UserMeasurementProfileValue::insert($data);
        return $data;
    }

}
