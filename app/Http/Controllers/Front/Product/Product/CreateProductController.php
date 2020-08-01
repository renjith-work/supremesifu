<?php

namespace App\Http\Controllers\Front\Product\Product;

use App\Models\Product\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use Session;
use Auth;
use Cart;
use Carbon\Carbon;

class CreateProductController extends Controller
{
    public function createProduct(Request $request)
    {
        $input = $request->data;
        return response()->json($input);
        $currentProduct = Product::find($input['product_id']);

        Cart::add(array(
            'id' => $currentProduct->id, // inique row ID
            'name' => $currentProduct->name,
            'price' => $input['price'],
            'quantity' => $input['quantity'],
        ));
        return response()->json($input);
    }
}
