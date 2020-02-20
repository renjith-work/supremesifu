<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValueSave extends Model
{
    public function product(){
    	return $this->belongsToMany('App\Models\Product\Product',  'product_id');
    }

    public function productAttribute(){
    	return $this->belongsToMany('App\Models\Product\ProductAttribute',  'product_attribute_id');
    }

    public function value(){
    	return $this->belongsTo('App\Models\Product\ProductAttributeValue',  'product_attribute_value_id');
    }
}
