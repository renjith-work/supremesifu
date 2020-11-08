<?php

namespace App\Models\Ecommerce\Order;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    public function order()
    {
        return $this->hasOne('App\Models\Ecommerce\Order\Order', 'order_address_id');
    }

    public function shippingAddress()
    {
        return $this->belongsTo('App\Models\Ecommerce\Order\UserOrderAddress', 'shipping_address_id');
    }

    public function billingAddress()
    {
        return $this->belongsTo('App\Models\Ecommerce\Order\UserOrderAddress', 'billing_address_id');
    }
}
