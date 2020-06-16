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
}
