<?php

namespace App\Models\Product\Fabric;

use Illuminate\Database\Eloquent\Model;

class FabricAttribute extends Model
{
    public function fabricAttributeValue()
	{
	 return $this->hasMany('App\Models\Product\Fabric\FabricAttributeValue');
	}

    public function fabric()
    {
        return $this->belongsToMany('App\Models\Product\Fabric\Fabric');
    }
}
