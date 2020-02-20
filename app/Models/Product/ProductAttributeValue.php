<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    public function productAttribute()
	{
	 return $this->belongsTo('App\Models\Product\ProductAttribute', 'product_attribute_id');
	}

	public function product()
    {
        return $this->belongsToMany('App\Models\Product\Product', 'product_product_attributes', 'product_attribute_value_id', 'product_id');
    }

    public function pavsaves(){
        return $this->hasMany('App\Models\Product\Pavsave',  'product_attribute_value_id');
    }
}
