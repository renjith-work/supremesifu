<?php

namespace App\Models\Measurement;

use Illuminate\Database\Eloquent\Model;

class MeasurementAttributeValue extends Model
{
    public function measurementAttribute()
	{
	 	return $this->belongsTo('App\Models\Measurement\MeasurementAttribute', 'measurement_attribute_id');
	}

	public function measurementProfile()
    {
        return $this->belongsToMany('App\Models\Measurement\MeasurementProfile', 'measurement_profile_values', 'value_id', 'profile_id');
    }
}
