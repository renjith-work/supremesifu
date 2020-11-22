<?php

namespace App\Http\Controllers\Front\User\Order;

use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Order\OrderItem;
use App\Models\Ecommerce\Order\UserOrderAddress;
use App\Models\Product\Product;
use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Fabric\FabricAttribute;
use App\Models\Product\Fabric\FabricAttributeValue;
use App\Models\Product\Monogram;
use App\Models\Product\ProductMonogram;
use App\Models\Product\ProductAttributeValueSave;
use App\Models\Measurement\UserProductMeasurement;
use App\Models\Measurement\MeasurementAttribute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use App\User;
use Auth;
use Session;
use Validator;

class OrderManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $orders  = Order::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        $order_array = array();
        foreach($orders as $item)
        {
            $order = new stdClass();
            $order->detail = $item;
            $order->shippingAddress = UserOrderAddress::find($item->address->shipping_address_id);
            $order->billingAddress = UserOrderAddress::find($item->address->billing_address_id);
            $order_array[] = $order;
        }
        // return response()->json($order_array);
        return view('front.user.orderManagement.index')->with('orders', $order_array);
    }

    public function details($order)
    {
        $user_id = Auth::user()->id;
        $order = Order::where('order_number', $order)->first();
        $order->shippingAddress = UserOrderAddress::find($order->address->shipping_address_id);
        $order->billingAddress = UserOrderAddress::find($order->address->billing_address_id);
        if( $user_id == $order->user_id)
        {
            return view('front.user.orderManagement.view')->with('order', $order);
        }else{
            return abort(404);
        }
        
    }

    public function product($order_id, $item_id)
    {
        $user_id = Auth::user()->id;
        $order = Order::find($order_id);
        if($user_id == $order->user_id)
        {
            $item = OrderItem::find($item_id);
            $product_id = $item->product_id;

            $product = Product::find($product_id);
            $product->fabric = $this->productFabric($product->fabric_id);
            $product->monograms = $this->productMonogram($product_id);
            $product->pockets = $this->pockets($product_id);
            $product->measurements = $this->productMeasurements($product);
            $product->images = $product->design->images;
            $product->order = $order->order_number;

            return view('front.user.orderManagement.item')->with('product', $product);
            return response()->json($product);
        } else {
            return abort(404);
        }
        
    }

    private function productFabric($id)
    {
        $fabric = Fabric::find($id);
        return $fabric;
    }

    private function productMonogram($id)
    {
        $productMonograms = ProductMonogram::where('product_id', $id)->get();
        $data = array();
        foreach($productMonograms as $productMonogram)
        {
            $monogram = new stdClass();
            $monogram->name = $productMonogram->monogram->name;
            $monogram->value = $productMonogram->value;
            $data[] = $monogram;
        }
        return $data;
    }

    private function pockets($id)
    {
        $data = ProductAttributeValueSave::where('product_id', $id)
                                        ->where('product_attribute_id', 4)
                                        ->firstOrFail();
        return $data->value->value;
    }

    private function productMeasurements($product)
    {
        $measurements = UserProductMeasurement::where('product_id', $product->id)->get();
        $measurement_attributes = MeasurementAttribute::where('product_attribute_set_id', $product->product_attribute_set_id)->get();
        $measurement_array = array();
        $item_value = null;
        foreach ($measurement_attributes as $attribute) {
            foreach ($measurements as $measurement) {
                if ($attribute->id == $measurement->m_at_id) {
                    $item_value = $measurement->value;
                    break;
                } else {
                    $item_value = null;
                }
            }

            $item = new stdClass();
            $item->name = $attribute->name;
            $item->value = $item_value;
            $measurement_array[] = $item;
            unset($item_value);
        }
        return $measurement_array;
    }
}
