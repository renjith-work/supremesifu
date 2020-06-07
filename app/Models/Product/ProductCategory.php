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

	public function products()
	{
		return $this->belongsToMany('App\Models\Product\Product','product_product_category', 'product_category_id', 'product_id');
	}

	public function fabrics()
	{
		return $this->belongsToMany('App\Models\Product\Fabric\Fabric', 'fabric_product_categories', 'product_category_id', 'fabric_id');
	}
}
