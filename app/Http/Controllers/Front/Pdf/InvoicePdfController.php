<?php

namespace App\Http\Controllers\Front\Pdf;

use App\Models\Ecommerce\Order\UserOrderAddress;
use App\Models\Ecommerce\Order\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PDF;
use Auth;

class InvoicePdfController extends Controller
{
    public function generateInvoicePdf($order_id)
    {
        $order = Order::find($order_id);
        $order->shippingAddress = UserOrderAddress::find($order->address->shipping_address_id);
        $order->billingAddress = UserOrderAddress::find($order->address->billing_address_id);
        $pdf = PDF::loadView('front.pdf.invoice', compact('order'));
        return $pdf->download('invoice.pdf');
    }
}
