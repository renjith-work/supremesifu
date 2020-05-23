<?php

namespace App\Models\Product\Inventory;

use Illuminate\Database\Eloquent\Model;

class InventoryUnitType extends Model
{
    public function units()
    {
        return $this->hasMany('App\Models\Product\Inventory\InventoryUnitType', 'type_id');
    }
}
