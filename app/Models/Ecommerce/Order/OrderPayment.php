<?php

namespace App\Models\Ecommerce\Order;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    public function order()
    {
        return $this->hasOne('App\Models\Ecommerce\Order\Order', 'order_payment_id');
    }
}
