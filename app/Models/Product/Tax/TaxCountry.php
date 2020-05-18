<?php

namespace App\Models\Product\Tax;

use Illuminate\Database\Eloquent\Model;

class TaxCountry extends Model
{
    public function zones()
    {
        return $this->hasMany('App\Models\Product\Tax\TaxZone');
    }
}
