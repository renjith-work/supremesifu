<?php

namespace App\Models\User\Address;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function zone()
    {
        return $this->belongsTo('App\Models\Settings\Zone', 'zone_id');
    }

    public function phoneCode()
    {
        return $this->belongsTo('App\Models\User\Address\PhoneCode', 'phone_code_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Settings\Country', 'country_id');
    }

    public function userAddressTypes()
    {
        return $this->hasMany('App\Models\User\Address\UserAddressType', 'user_address_id');
    }
    
}
