<?php

namespace App\Http\Controllers\Front\Product;

use App\Models\Product\ProductDesign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductDesignController extends Controller
{
	public function index()
	{
		$products = ProductDesign::orderBy('id', 'desc')->get();	
		return view('front.product.design.index')->with('products', $products);
	}
	
    public function detail($id)
    {
    	$product = ProductDesign::find($id);
    	return view('front.product.design.detail')->with('product', $product);
    }

    public function loadImages(Request $request){
        $id = $request->id;
        $product = ProductDesign::find($id);
        $image1[] = $product->p_image;
        $image1[] = $product->s_image;
        $image2 = json_decode($product->album, true);
        $images = array_merge($image1, $image2);
        $data[] = array(
                    'folder' => $product->folder,
                    'images' => $images 
        );
        return response()->json($data);
    }
}
