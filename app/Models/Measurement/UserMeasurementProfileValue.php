<?php

namespace App\Models\Measurement;

use Illuminate\Database\Eloquent\Model;

class UserMeasurementProfileValue extends Model
{
   	public function measurementAttribute(){
    	return $this->belongsTo('App\Models\Measurement\MeasurementAttribute',  'm_at_id');
    }

    public function umprofile(){
    	return $this->belongs('App\Models\Measurement\UserMeasurementProfile',  'u_mp_id');
    }
}
