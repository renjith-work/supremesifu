<?php

namespace App\Models\Product\File;

use Illuminate\Database\Eloquent\Model;

class ProductDocument extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product', 'product_id');
    }
}
