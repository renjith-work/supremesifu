<?php

namespace App\Models\Product\Design;

use Illuminate\Database\Eloquent\Model;

class ProductDesignWeight extends Model
{
    public function productDesign()
    {
        return $this->belongsTo('App\Models\Product\Design\ProductDesign');
    }
}
