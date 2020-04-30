<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    public function attributeSet()
	{
	 return $this->belongsTo('App\Models\Product\ProductAttributeSet', 'product_attribute_set_id');
	}

	public function productAttributeValues()
	{
	 return $this->hasMany('App\Models\Product\ProductAttributeValue');
	}

	public function pavsaves(){
        return $this->hasMany('App\Models\Product\Pavsave',  'product_attribute_id');
    }
}
