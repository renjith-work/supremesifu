<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeSet extends Model
{
    public function attributes()
    {
        return $this->hasMany('App\Models\Product\ProductAttribute');
    }

    public function fabricPrices()
    {
        return $this->hasMany('App\Models\Product\Fabric\FabricPrice', 'product_attribute_set_id');
    }

    public function monograms()
    {
        return $this->hasMany('App\Models\Product\Monogram', 'product_attribute_set_id');
    }

    public function measurementProfiles()
    {
        return $this->hasMany('App\Models\Measurement\UserMeasurementProfile', 'product_attribute_set_id');
    }

    public function measurementAttributes()
    {
        return $this->hasMany('App\Models\Measurement\MeasurementAttribute', 'product_attribute_set_id');
    }
}
