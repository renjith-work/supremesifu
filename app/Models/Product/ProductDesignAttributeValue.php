<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductDesignAttributeValue extends Model
{
    public function productDesign()
	{
		return $this->belongsTo('App\Models\Product\ProductDesign', 'product_design_id');
	}

	public function productAttribute()
	{
		return $this->belongsTo('App\Models\Product\ProductAttribute', 'product_attribute_id');
	}

	public function productAttributeValue()
	{
		return $this->belongsTo('App\Models\Product\ProductAttributeValue', 'product_attribute_value_id');
	}
}
