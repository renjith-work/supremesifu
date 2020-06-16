<?php

namespace App\Http\Controllers\Front\Product;

use App\Models\Product\Product;
use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Monogram;
use App\Models\Product\ProductMonogram;
use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductAttributeValueSave;
use App\Models\Product\ProductDesign;
use App\Models\MeasurementAttribute;
use App\Models\UserMeasurementProfile;
use App\Models\UMProfileValue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use Auth;
use Cart;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'asc')->get();    
        // return response()->json($products);
        return view('front.product.shirt.index')->with('products', $products);
    }

    public function detail($slug)
    {
        $product = Product::where('slug', '=', $slug)->first();
        return view('front.product.shirt.detail')->with('product', $product);
    }

    public function createProduct(Request $request)
    {   
        // $input = $request->all();
        // return response()->json($input);
        if($user = Auth::user())
        {
            $user_id = Auth::user()->id;
            $session_id = $session_id = Session::getId();
            $input = $request->all();

            $monogram_array = [];
            $monograms = Monogram::where('product_category_id', 3)->get();
            foreach($monograms as $monogram){
                if (array_key_exists($monogram->code, $input)) {
                    if (isset($input[$monogram->code])) {
                        $monogram_array[] = array(
                                            'monogram_id' => $monogram->id,
                                            'value' => $input[$monogram->code],
                        );
                    } 
                }
            }

            $design = ProductDesign::find($input['design']);
            $fabric = Fabric::find($input['fabric']);

            $product = new Product;
            $product->user_id = $user_id;
            $product->session_id = $session_id;
            $product->product_design_id = $design->id;
            $product->product_category_id = 3;
            $product->fabric_id = $fabric->id;
            $product->name = $fabric->name.' '.$design->name;
            $product->price = $design->price;
            $product->og_price = $design->og_price;
            $product->description = $design->description;
            $product->summary = $design->summary;
            $product->p_image = $design->p_image;
            $product->s_image = $design->s_image;
            $product->album = $design->album;
            $product->folder = $design->folder;
            $product->save();

            $product->monogram()->sync($monogram_array, false);
            
            $attribute_array = [];
            $attributes = ProductAttribute::where('product_category_id', 3)->get();
            foreach($attributes as $attribute){
                if (array_key_exists($attribute->code, $input)) {
                    if (isset($input[$attribute->code])) {
                        $attribute_array[] = array(
                                            'product_id' => $product->id,
                                            'product_attribute_id' => $attribute->id,
                                            'product_attribute_value_id' => $input[$attribute->code],
                        );
                    } 
                }
            }

            ProductAttributeValueSave::insert($attribute_array);
            return view('front.product.custom.shirt.measurement.index')->with('product', $product->id);

        }else{
            session(['url.intended' => '/custom-shirt/fabric/class']);
            return redirect('/login');
        }
    }

    public function loadImages(Request $request){
        $id = $request->id;
        $product = Product::find($id);

        $images = $product->images;
        $image_array = array();
        foreach($images as $image){
            $image_array[] = array(
                            'name' => $image->name,
                            'position' => $image->position_id,
            );
        }

        return response()->json($image_array);
    }
}
