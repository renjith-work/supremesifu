<?php

namespace App\Models\Product\Fabric;

use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{
    public function fabricAttributeValues()
    {
        return $this->belongsToMany('App\Models\Product\Fabric\FabricAttributeValue');
    }

    public function brand()
	{
	 return $this->belongsTo('App\Models\Product\Fabric\FabricBrand', 'brand_id');
	}

	public function class()
	{
	 return $this->belongsTo('App\Models\Product\Fabric\FabricClass', 'fabric_class_id');
	}

	public function status()
	{
	 return $this->belongsTo('App\Models\Product\Fabric\FabricStatus', 'status_id');
	}

	public function products()
	{
	 return $this->hasMany('App\Models\Product');
	}

	public function productCategories()
	{
		return $this->belongsToMany('App\Models\Product\ProductCategory', 'fabric_product_categories', 'fabric_id', 'product_category_id');
	}

	public function prices()
	{
		return $this->hasMany('App\Models\Product\Fabric\FabricPrice', 'fabric_id');
	}
}
