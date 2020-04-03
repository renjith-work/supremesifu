<?php

namespace App\Models\Product\Fabric;

use Illuminate\Database\Eloquent\Model;

class FabricBrand extends Model
{
    public function fabric()
	{
		return $this->hasMany('App\Models\Product\Fabric');
	}

	public function status()
	{
		return $this->belongsTo('App\Models\Status', 'status_id');
	}
}
