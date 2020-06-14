<?php

namespace App\Models\Product\Design;

use Illuminate\Database\Eloquent\Model;

class ProductDesignImage extends Model
{
    protected $fillable = ['product_design_id', 'position_id', 'name'];
}
