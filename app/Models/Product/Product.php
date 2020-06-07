<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function monogram()
    {
        return $this->belongsToMany('App\Models\Product\ProductMonogram', 'product_monograms', 'product_id', 'monogram_id');
    }

    public function attributeValue()
    {
        return $this->belongsToMany('App\Models\Product\ProductAttributeValue', 'product_product_attributes', 'product_id', 'product_attribute_value_id');
    }

    public function umprofile()
    {
        return $this->belongsTo('App\Models\Measurement\UserMeasurementProfile', 'u_mp_id');
    }

    public function design()
    {
        return $this->belongsTo('App\Models\Product\ProductDesign', 'product_design_id');
    }

    public function fabric()
    {
        return $this->belongsTo('App\Models\Product\Fabric\Fabric', 'fabric_id');
    }

    public function pavsaves(){
        return $this->belongsToMany('App\Models\Product\ProductAttributeValue',  'product_attribute_value_saves', 'product_id', 'product_attribute_id', 'product_attribute_value_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_items', 'order_id');
    }

    public function attributes(){
        return $this->hasMany('App\Models\Product\ProductAttributeValueSave', 'product_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Product\Brand', 'brand_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Product\Image\ProductImagePosition', 'product_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Product\ProductCategory', 'product_product_category', 'product_id', 'product_category_id');
    }

    public function price()
    {
        return $this->hasOne('App\Models\Product\ProductPrice', 'product_id');
    }

    public function inventory()
    {
        return $this->hasOne('App\Models\Product\Inventory\Inventory', 'product_id');
    }

    public function weight()
    {
        return $this->hasOne('App\Models\Product\Weight\ProductWeight', 'product_id');
    }
}
