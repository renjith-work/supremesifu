<?php

namespace App\Models\Measurement;

use Illuminate\Database\Eloquent\Model;

class UserMeasurementProfile extends Model
{
	public function product(){
    	return $this->hasMany('App\Models\Product\Product',  'u_mp_id');
   }

   	public function umpvalue(){
		return $this->hasMany('App\Models\Measurement\UserMeasurementProfile',  'u_mp_id');
	}

	public function mppavalues(){
		return $this->hasMany('App\Models\Measurement\MeasureProfileProductAttributeValue',  'mp_id');
	}

	public function values()
	{
		return $this->hasMany('App\Models\Measurement\UserMeasurementProfileValue',  'u_mp_id');
	}
}
