<?php

namespace App\Models\User\Address;

use Illuminate\Database\Eloquent\Model;

class PhoneCode extends Model
{
    public function country()
    {
        return $this->belongsTo('App\Models\Settings\Country', 'country_id');
    }
}
