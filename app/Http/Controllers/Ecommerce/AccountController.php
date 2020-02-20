<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function getOrders()
    {
        $orders = auth()->user()->orders;
        return view('front.eCommerce.orders', compact('orders'));
    }
}
