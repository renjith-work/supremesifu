<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Cart;
use App\Services\PayPalService;


class CheckoutController extends Controller
{
	protected $payPal;

	public function __construct(PayPalService $payPal)
    {
        $this->payPal = $payPal;
    }

    public function getCheckout()
    {
        return view('front.eCommerce.checkout');
    }

    public function placeOrder(Request $request)
    {
    	// var_dump($request);
        // Before storing the order we should implement the
        // request validation which I leave it to you
        // $order = $this->orderRepository->storeOrderDetails($request->all());

        // dd($order);
        
        $order = Order::create([
	        'order_number'      =>  'ORD-'.strtoupper(uniqid()),
	        'user_id'           => auth()->user()->id,
	        'status'            =>  'pending',
	        'grand_total'       =>  Cart::getSubTotal(),
	        'item_count'        =>  Cart::getTotalQuantity(),
	        'payment_status'    =>  0,
	        'payment_method'    =>  null,
	        'first_name'        =>  $request->first_name,
	        'last_name'         =>  $request->last_name,
	        'address'           =>  $request->address,
	        'city'              =>  $request->city,
	        'country'           =>  $request->country,
	        'post_code'         =>  $request->post_code,
	        'phone_number'      =>  $request->phone_number,
	        'notes'             =>  $request->notes
	    ]);

        if ($order) {

	        $items = Cart::getContent();

	        foreach ($items as $item)
	        {
	            // A better way will be to bring the product id with the cart items
	            // you can explore the package documentation to send product id with the cart
	            $product = Product::where('id', $item->id)->first();

	            $orderItem = new OrderItem([
	                'product_id'    =>  $product->id,
	                'quantity'      =>  $item->quantity,
	                'price'         =>  $item->getPriceSum()
	            ]);

	            $order->items()->save($orderItem);
	        }
	    }

	    if ($order) {
	        $this->payPal->processPayment($order);
	    }

	    return response()->json('Order not placed');
	    // return redirect()->back()->with('message','Order not placed');


    // return $order;
    	// if ($order) {
	    //     return response()->json($order);
	    // }
        
    }

    public function complete(Request $request)
	{
	    $paymentId = $request->input('paymentId');
	    $payerId = $request->input('PayerID');

	    $status = $this->payPal->completePayment($paymentId, $payerId);

	    $order = Order::where('order_number', $status['invoiceId'])->first();
	    $order->status = 'processing';
	    $order->payment_status = 1;
	    $order->payment_method = 'PayPal -'.$status['salesId'];
	    $order->save();

	    Cart::clear();
	    return view('front.eCommerce.success', compact('order'));
	}
}
