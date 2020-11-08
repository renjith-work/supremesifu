<?php

namespace App\Models\Ecommerce\Order;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public function orders()
    {
        return $this->hasMany('App\Models\Ecommerce\Order\Order', 'order_status_id');
    }
}
