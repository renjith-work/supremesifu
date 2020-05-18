<?php

namespace App\Models\Product\Tax;

use Illuminate\Database\Eloquent\Model;

class TaxZone extends Model
{
    public function country()
    {
        return $this->belongsTo('App\Models\Product\Tax\TaxZone', 'tax_country_id');
    }
}
