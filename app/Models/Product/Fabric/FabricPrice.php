<?php

namespace App\Models\Product\Fabric;

use Illuminate\Database\Eloquent\Model;

class FabricPrice extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product\ProductAttributeSet', 'product_attribute_set_id');
    }

    public function fabric()
    {
        return $this->belongsTo('App\Models\Product\Fabric\Fabric', 'fabric_id');
    }
}
