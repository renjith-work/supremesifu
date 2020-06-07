<?php

namespace App\Models\Product\Image;

use Illuminate\Database\Eloquent\Model;

class ProductImagePosition extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product', 'product_id');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\Product\Image\ProductImagePosition', 'position_id');
    }
}
