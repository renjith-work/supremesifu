<?php

namespace App\Models\Product\Inventory;

use Illuminate\Database\Eloquent\Model;

class InventoryUnit extends Model
{
    public function type()
    {
        return $this->belongsTo('App\Models\Product\Inventory\InventoryUnitType', 'type_id');
    }
}
