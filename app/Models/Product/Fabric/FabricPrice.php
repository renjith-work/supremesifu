<?php

namespace App\Models\Product\Fabric;

use Illuminate\Database\Eloquent\Model;

class FabricPrice extends Model
{
    public function attribute()
    {
        return $this->belongsTo('App\Models\Product\Fabric\FabricPrice', 'product_attribute_set_id');
    }

    public function fabric()
    {
        return $this->belongsTo('App\Models\Product\Fabric\Fabric', 'fabric_id');
    }
}
