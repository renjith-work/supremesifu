<?php

namespace App\Models\Measurement;

use Illuminate\Database\Eloquent\Model;

class MeasurementAttribute extends Model
{
    public function measurementCategory()
	{
		return $this->belongsTo('App\Models\Measurement\MeasurementCategory', 'measurement_category_id');
	}

	public function measurementAttributeValue()
	{
	 	return $this->hasMany('App\Models\Measurement\MeasurementAttributeValue', 'measurement_attribute_id');
	}

	public function userMeasurementProfileValue(){
    	return $this->hasMany('App\Models\Measurement\UserMeasurementProfileValue',  'm_at_id');
	}

	public function productAttributeSet()
	{
		return $this->belongsTo('App\Models\Product\roductAttributeSet', 'product_attribute_set_id');
	}
}
