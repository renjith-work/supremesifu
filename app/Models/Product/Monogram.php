<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Monogram extends Model
{
    public function product()
    {
        return $this->belongsToMany('App\Models\Product\ProductMonogram', 'product_monograms', 'monogram_id', 'product_id');
    }
}
