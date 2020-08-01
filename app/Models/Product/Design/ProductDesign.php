<?php

namespace App\Models\Product\Design;

use Illuminate\Database\Eloquent\Model;

class ProductDesign extends Model
{
    public function attributeSet()
    {
        return $this->belongsTo('App\Models\Product\ProductAttributeSet', 'product_attribute_set_id');
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\Product\Design\ProductDesignAttributeValueSave', 'product_design_id');
    }

    public function fabric()
    {
        return $this->belongsTo('App\Models\Product\Fabric\Fabric', 'fabric_id');
    }

    public function taxClass()
    {
        return $this->belongsTo('App\Models\Product\Tax\TaxClass', 'tax_class_id');
    }

    public function price()
    {
        return $this->hasOne('App\Models\Product\Design\ProductDesignPrice', 'product_design_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Product\Design\ProductDesignImage', 'product_design_id');
    }

    public function videos()
    {
        return $this->hasMany('App\Models\Product\Design\ProductDesignVideo', 'product_design_id');
    }

    public function weight()
    {
        return $this->hasOne('App\Models\Product\Design\ProductDesignWeight', 'product_design_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product\Product', 'product_design_id');
    }
}
