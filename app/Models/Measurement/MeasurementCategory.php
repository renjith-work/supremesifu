<?php

namespace App\Models\Measurement;

use Illuminate\Database\Eloquent\Model;

class MeasurementCategory extends Model
{
    public function measurementAttribute()
	{
	 	return $this->hasMany('App\Models\Measurement\MeasurementAttribute');
	}
}
