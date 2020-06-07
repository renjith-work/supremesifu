<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public function country()
    {
        return $this->belongsTo('App\Models\Settings\Country', 'country_id');
    }
}
