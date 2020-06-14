<?php

namespace App\Models\Product\Design;

use Illuminate\Database\Eloquent\Model;

class ProductDesignVideo extends Model
{
    protected $fillable = ['product_design_id', 'name'];

    public function design()
    {
        return $this->belongsTo('App\Models\Product\Design\ProductDesign', 'product_design_id');
    }
}
