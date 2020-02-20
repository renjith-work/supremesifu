<?php

namespace App\Models\Product\Fabric;

use Illuminate\Database\Eloquent\Model;

class FabricStatus extends Model
{
    public function fabrics()
	{
		return $this->hasMany('App\Models\Product\Fabric\Fabric');
	}
}
