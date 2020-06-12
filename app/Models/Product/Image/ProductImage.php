<?php

namespace App\Models\Product\Image;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'position_id', 'name'];
}
