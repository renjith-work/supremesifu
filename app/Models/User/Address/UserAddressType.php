<?php

namespace App\Models\User\Address;

use Illuminate\Database\Eloquent\Model;

class UserAddressType extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\User\Address\UserAddress', 'user_address_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\User\Address\AddressType', 'address_type_id');
    }
}
