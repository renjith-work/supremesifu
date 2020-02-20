<?php

namespace App\Http\Controllers\Front\Product\Design\Shirt;

use App\Models\Product\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ConfirmController extends Controller
{
    public function confirm($id){
    	$user_id = Auth::user()->id;
    	$product = Product::find($id);
    	if($product->user_id == $user_id){
    		return view('front.product.custom.shirt.confirm')->with('product', $product);
    	}else{
    		return redirect()->route('design.shirt.create');
    	}
    }
}
