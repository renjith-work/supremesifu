<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public function parent()
	{
	    return $this->belongsTo(ProductCategory::class, 'parent_id');
	}

	public function children()
	{
	    return $this->hasMany(ProductCategory::class, 'parent_id');
	}

	public function attribute()
	{
		return $this->hasMany('App\Models\Product\ProductAttribute');
	}
}
