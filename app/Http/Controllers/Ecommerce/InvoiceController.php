<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function print($id){
    	$order = Order::find($id);
    	return view('admin.invoices.invoice')->with('order', $order);
    }
}
