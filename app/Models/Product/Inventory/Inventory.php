<?php

namespace App\Models\Product\Inventory;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product');
    }
}
