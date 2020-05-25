<?php

namespace App\Models\Product\Inventory;

use Illuminate\Database\Eloquent\Model;

class InventoryUnit extends Model
{
    public function unit()
    {
        return $this->belongsTo('App\Models\Product\Inventory\InventoryUnit', 'inventory_unit_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product', 'product_id');
    }
    
}
