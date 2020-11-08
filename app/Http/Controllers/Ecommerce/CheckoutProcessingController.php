<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Order\OrderAddress;
use App\Models\Ecommerce\Order\UserOrderAddress;
use App\Models\Product\Product;
use App\Models\Ecommerce\Order\OrderItem;
use App\Models\Ecommerce\Order\OrderPayment;
use App\Models\User\Address\UserAddressType;
use App\Models\User\Address\UserAddress;

use Cart;
use PDF;
use App\Services\PayPalService;

use stdClass;
use App\User;
use Auth;
use Session;
use Validator;
  

class CheckoutProcessingController extends Controller
{
    protected $payPal;

    public function __construct(PayPalService $payPal)
    {
        $this->payPal = $payPal;
    }

    public function placeOrder(Request $request)
    {

        if(Cart::getTotalQuantity() < 1){
            Session::flash('error', 'There are no items in your cart to checkout.');
            return redirect()->back();
        }else{
            $validator = Validator::make(
                $request->all(),
                [
                    'billing_address' => 'required',
                    'shipping_address' => 'required',
                ],
                [
                    'billing_address.required' => 'Please provide a billing address.',
                    'shipping_address.required' => 'Please provide a shipping address.',
                ]
            );

            if ($validator->passes()) {

                $order = new Order;
                $order->order_number = 'ORD-' . strtoupper(uniqid());
                $order->user_id = Auth::user()->id;
                $order->order_status_id = 1;
                $order->order_payment_id = $this->orderPayment();
                $order->item_count = Cart::getTotalQuantity();
                $order->payment_status = 0;
                $order->payment_method = null;
                $order->order_address_id = $this->orderAddress($request->billing_address, $request->shipping_address);
                $order->save();
                $this->saveOrderItems($order->id);

                if ($order) {
                    $this->payPal->processPayment($order);
                }

                return response()->json('Order not placed');  

            } else {
                return redirect()->back()->withErrors($validator);
            }
        }
    }

    private function saveOrderItems($order_id)
    {
        $items = Cart::getContent();
        foreach ($items as $item) {
            $product = Product::where('id', $item->id)->first();
            $orderItem = new OrderItem;
            $orderItem->order_id    =  $order_id;
            $orderItem->product_id    =  $product->id;
            $orderItem->quantity      =  $item->quantity;
            $orderItem->price         =  $item->price;
            $orderItem->total_price   =  $item->getPriceSum();
            $orderItem->save();
        }
    }

    private function orderPayment()
    {
        $payment = new Orderpayment;
        $payment->grand_total = Cart::getSubTotal();
        $payment->total = Cart::getTotal();
        $payment->shipping = 10;
        $payment->tax = 0;
        $payment->save();
        return $payment->id;
    }    

    private function orderAddress($billing_address, $shipping_address)
    {
        $billingAddress = UserAddress::find($billing_address);
        $shippingAddress = UserAddress::find($shipping_address);

        $address = new OrderAddress;
        $address->billing_address_id = $this->saveAddress($billingAddress);
        $address->shipping_address_id = $this->saveAddress($shippingAddress);
        $address->save();

        return $address->id;
    }

    private function saveAddress($current_address)
    {
        $address = new UserOrderAddress;
        $address->user_id = Auth::user()->id;
        $address->first_name = $current_address->first_name;
        $address->last_name = $current_address->last_name;
        $address->email = $current_address->email;
        $address->phone_code_id = $current_address->phone_code_id;
        $address->phone = $current_address->phone;
        $address->zone_id = $current_address->zone_id;
        $address->city = $current_address->city;
        $address->country_id = $current_address->country_id;
        $address->postcode = $current_address->postcode;
        $address->address = $current_address->address;
        $address->save();
        return $address->id;
    }

    public function complete(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        
        $status = $this->payPal->completePayment($paymentId, $payerId);

        $order = Order::where('order_number', $status['invoiceId'])->first();
        $order->order_status_id = 2;
        $order->payment_status = 1;
        $order->payment_method = 'PayPal -' . $status['salesId'];
        $order->save();

        $order->shippingAddress = UserOrderAddress::find($order->address->shipping_address_id);
        $order->billingAddress = UserOrderAddress::find($order->address->billing_address_id);

        $pdf = PDF::loadView('front.pdf.invoice', compact('order'));
        $message = new InvoiceMail($order);
        $message->attachData($pdf->output(), "invoice.pdf");
        Mail::to($order->billingAddress->email)->send($message);

        Cart::clear();
        return view('front.eCommerce.complete')->with('order', $order);

    }

    public function completeOrder()
    {
        $order = Order::find(8);
        $order->shippingAddress = UserOrderAddress::find($order->address->shipping_address_id);
        $order->billingAddress = UserOrderAddress::find($order->address->billing_address_id);

        $pdf = PDF::loadView('front.pdf.invoice', compact('order'));
        $message = new InvoiceMail($order);
        $message->attachData($pdf->output(), "invoice.pdf");
        Mail::to('test@test.com')->send($message);

        return view('front.eCommerce.complete')->with('order', $order);
    }

    public function test()
    {
        $order = Order::find(5);
        $data = new stdClass();
        $data->order = $order;
        $items_array = array();
        foreach($order->items as $item)
        {
            $items_array[] = $item->product;
        }
        $data->product = $items_array;
        $data->user = $order->user->fname . ' ' . $order->user->lname;
        $data->items = $order->items;
        $data->payment = $order->payment;
        $data->shipping = $order->payment->shipping;
        $data->tax = $order->payment->tax;
        $data->address = $order->address;
        $data->shipping_address = $order->address->shippingAddress;
        $data->billing_address = $order->address->billingAddress;
        
        $this->payPal->processPayment($order);
        // return response()->json($order->payment->shipping);
        // return response()->json($order);
    }

    private function mailInvoice()
    {

        

        $data["email"] = 'test@test.com';
        $data["client_name"] = 'Renjith';
        $data["subject"] = 'Test invoice mail';

        $pdf = PDF::loadView('front.pdf.invoice', $data);

        try {
            Mail::send('emails.ecommerce.invoice', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["client_name"])
                ->subject($data["subject"])
                ->attachData($pdf->output(), "invoice.pdf");
            });
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail";
            $this->statuscode  =   "0";
        } else {

            $this->statusdesc  =   "Message sent Succesfully";
            $this->statuscode  =   "1";
        }
        return response()->json(compact('this'));
        
    }

    public function pdfgenerator()
    {
        $pdf = PDF::loadView('front.pdf.invoice');
        return $pdf->download('invoice.pdf');
    }

    public function pdfView()
    {
        return view('front.pdf.invoice');
    }
}
