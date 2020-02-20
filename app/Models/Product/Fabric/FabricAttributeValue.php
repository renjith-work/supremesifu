<?php

namespace App\Models\Product\Fabric;

use Illuminate\Database\Eloquent\Model;

class FabricAttributeValue extends Model
{
    public function fabricAttribute()
	{
		return $this->belongsTo('App\Models\Product\Fabric\FabricAttribute', 'fabric_attribute_id');
	}

    public function fabric()
    {
        return $this->belongsToMany('App\Models\Product\Fabric\Fabric');
    }
}
