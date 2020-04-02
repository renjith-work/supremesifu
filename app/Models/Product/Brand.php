<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function fabric()
	{
		return $this->hasMany('App\Models\Product\Fabric');
	}

	public function products()
	{
		return $this->hasMany('App\Models\Product\Product');
	}
}
