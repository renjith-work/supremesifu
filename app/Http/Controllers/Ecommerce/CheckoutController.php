<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Cart;
use App\Services\PayPalService;

use App\User;
use Auth;
use App\Models\User\Address\UserAddress;  
use App\Models\User\Address\UserAddressType;  

class CheckoutController extends Controller
{
	protected $payPal;

	public function __construct(PayPalService $payPal)
    {
        $this->payPal = $payPal;
    }

    public function getCheckout()
    {
		$user_id = Auth::user()->id;
		$user = User::find($user_id);
		
		$shippng_address = NULL;
		$billing_address = NULL;

		$billing_address = $this->getBillingAddress($user);
		$shipping_address = $this->getShippingAddress($user);

        return view('front.eCommerce.checkout')->with('billing_address', $billing_address)->with('shipping_address', $shipping_address);
	}
	
	private function getBillingAddress($user)
	{
		$billing_address = NULL;
		$b_address = null;
		foreach ($user->addresses as $address) {
			$b_address = UserAddressType::where('user_id', $user->id)
										->where('address_type_id', 1)->first();
			if ($b_address != null) {
				$billing_address = UserAddress::find($b_address->user_address_id);
				break;
			}
		}
		return $billing_address;
	}

	private function getShippingAddress($user)
	{
		$shipping_address = NULL;
		$b_address = null;
		foreach ($user->addresses as $address) {
			$b_address = UserAddressType::where('user_id', $user->id)
										->where('address_type_id', 2)->first();
			if ($b_address != null) {
				$shipping_address = UserAddress::find($b_address->user_address_id);
				break;
			}
		}
		return $shipping_address;
	}

    public function placeOrder(Request $request)
    {
		
		$billing_address = UserAddress::find($request->billing_address);
		$shipping_address = UserAddress::find($request->shipping_address);
    	// var_dump($request);
        // Before storing the order we should implement the
        // request validation which I leave it to you
        // $order = $this->orderRepository->storeOrderDetails($request->all());

        // dd($order);
        
        $order = Order::create([
	        'order_number'      =>  'ORD-'.strtoupper(uniqid()),
	        'user_id'           => 	auth()->user()->id,
	        'status'            =>  'pending',
	        'grand_total'       =>  Cart::getSubTotal(),
	        'item_count'        =>  Cart::getTotalQuantity(),
	        'payment_status'    =>  0,
	        'payment_method'    =>  null,
	        'first_name'        =>  $billing_address->name,
	        // 'last_name'         =>  $request->last_name,
	        'address'           =>  $billing_address->address,
	        'city'              =>  $billing_address->city,
	        'country'           =>  $billing_address->zone->country->name,
	        'post_code'         =>  $billing_address->postcode,
	        'phone_number'      =>  $billing_address->phoneCode->value. $billing_address->phone,
		]);

		return response()->json($order);

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
