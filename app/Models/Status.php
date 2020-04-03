<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function brands()
	{
		return $this->hasMany('App\Models\Product\Brand', 'status_id');
	}

	public function fabricBrands()
	{
		return $this->hasMany('App\Models\Product\Fabric\FabricBrand', 'status_id');
	}
}
