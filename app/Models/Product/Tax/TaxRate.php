<?php

namespace App\Models\Product\Tax;

use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    public function class()
    {
        return $this->belongsTo('App\Models\Product\Tax\TaxClass', 'tax_class_id');
    }

    public function zone()
    {
        return $this->belongsTo('App\Models\Settings\Zone', 'tax_zone_id');
    }

}
