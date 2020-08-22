<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Cart;
use stdClass;

class CartUpdateController extends Controller
{
    public function update(Request $request)
    {
        
        Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty,
            ),
        ));

        $data = new stdClass();
        $data->price = Cart::get($request->id)->getPriceSum();
        $data->total = Cart::getSubTotal();

        return response()->json($data);
    }
}
