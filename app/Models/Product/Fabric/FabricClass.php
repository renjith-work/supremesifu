<?php

namespace App\Models\Product\Fabric;

use Illuminate\Database\Eloquent\Model;

class FabricClass extends Model
{
    public function fabric()
	{
		return $this->hasMany('App\Models\Product\Fabric');
	}
}
