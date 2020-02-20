<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
    	$orders = Order::orderBy('id', 'desc')->paginate(15);
        return view('admin.eCommerce.orders.index')->with('orders', $orders);
    }

    public function view($id){
    	$order = Order::where('order_number', $id)->first();
    	return view('admin.eCommerce.orders.show')->with('order', $order);
    }
}
