<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductMonogram extends Model
{
    public function product()
	{
	 	return $this->belongsTo('App\Models\Product\Product', 'product_id');
	}

    public function monogram()
    {
        return $this->belongsTo('App\Models\Product\Monogram', 'monogram_id');
    }
}
