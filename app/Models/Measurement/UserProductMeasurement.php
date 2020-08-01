<?php

namespace App\Models\Measurement;

use Illuminate\Database\Eloquent\Model;

class UserProductMeasurement extends Model
{
    public function userMeasurementProfile()
    {
        return $this->belongsTo('App\Models\Measurement\UserMeasurementProfile', 'ump_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product', 'product_id');
    }

    public function measurementAttribute()
    {
        return $this->belongsTo('App\Models\Measurement\MeasurementAttribute', 'm_at_id');
    }
}
