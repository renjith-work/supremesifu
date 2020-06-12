<?php

namespace App\Models\Product\File;

use Illuminate\Database\Eloquent\Model;

class ProductVideo extends Model
{
    protected $fillable = ['product_id','name'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product', 'product_id');
    }
}
