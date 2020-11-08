<?php

namespace App\Models\Ecommerce\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Ecommerce\Order\OrderItem', 'order_id');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Ecommerce\Order\OrderAddress', 'order_address_id');
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\Ecommerce\Order\OrderPayment', 'order_payment_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Ecommerce\Order\OrderStatus', 'order_status_id');
    }
}
