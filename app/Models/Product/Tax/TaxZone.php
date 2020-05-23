<?php

namespace App\Models\Product\Tax;

use Illuminate\Database\Eloquent\Model;

class TaxZone extends Model
{
    public function country()
    {
        return $this->belongsTo('App\Models\Product\Tax\TaxCountry', 'tax_country_id');
    }

    public function rates()
    {
        return $this->hasMany('App\Models\Product\Tax\TaxRate', 'tax_zone_id');
    }
}
