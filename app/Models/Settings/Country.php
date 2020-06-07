<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function zones()
    {
        return $this->hasMany('App\Models\Settings\Zone', 'country_id');
    }
}
