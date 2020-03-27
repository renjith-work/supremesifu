<?php

namespace App\Models\Measurement;

use Illuminate\Database\Eloquent\Model;

class MeasureProfileProductAttributeValue extends Model
{
    public function measurementProfile()
	{
		return $this->belongsTo('App\Models\Measurement\UserMeasurementProfile', 'mp_id');
	}

	public function productAtributeValue()
	{
		return $this->belongsTo('App\Models\Product\ProductAttributeValue', 'product_attribute_value_id');
	}
}
