<?php

namespace App\Models\Product\Design;

use Illuminate\Database\Eloquent\Model;

class ProductDesignAttributeValueSave extends Model
{
    public function design()
    {
        return $this->belongsToMany('App\Models\Product\Design\ProductDesign',  'product_design_id');
    }

    public function productAttribute()
    {
        return $this->belongsTo('App\Models\Product\ProductAttribute', 'product_attribute_id');
    }

    public function value()
    {
        return $this->belongsTo('App\Models\Product\ProductAttributeValue',  'product_attribute_value_id');
    }
}
