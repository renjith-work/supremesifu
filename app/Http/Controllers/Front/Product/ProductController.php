<?php

namespace App\Http\Controllers\Front\Product;

use App\Models\Product\Product;
use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Monogram;
use App\Models\Product\ProductMonogram;
use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductAttributeValueSave;
use App\Models\Product\ProductDesign;
use App\Models\Measurement\UserMeasurementProfile;
use App\Models\MeasurementAttribute;
use App\Models\UMProfileValue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use Session;
use Auth;
use Cart;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
        $products = $this->listproduct();
        return view('front.product.shirt.index')->with('products', $products);
    }

    public function detail($slug)
    {
        $product = Product::where('slug', '=', $slug)->first();
        
        $shirtPockets = $this->shirtPocket($product);
        $productPrice = $this->shirtPrice($product);
        $defaultMeasurementProfile = $this->defaultMeasurementProfile($product);
        $userMeasurementProfile = $this->userMeasurementProfile($product);

        return view('front.product.shirt.detail')->with('product', $product)->with('productPrice', $productPrice)->with('shirtPockets', $shirtPockets)->with('userMeasurementProfile', $userMeasurementProfile)->with('defaultMeasurementProfile', $defaultMeasurementProfile);
    }

    private function defaultMeasurementProfile($product)
    {
        $measurementProfiles = $product->attributeSet->measurementProfiles;
        $measurementProfile_array = array();
        foreach($measurementProfiles as $profile) 
        {
            if ($profile->user_id == 1) {
                $dmProfile = new stdClass();
                $dmProfile->id = $profile->id;
                $dmProfile->name = $profile->name;
                $measurementProfile_array[] = $dmProfile;
            }
        }
        return $measurementProfile_array;
    }

    private function userMeasurementProfile($product)
    {
        if (Auth::check()) {
        $measurementProfiles = $product->attributeSet->measurementProfiles;
        $user_id = Auth::user()->id;
        $measurementProfile_array = array();
        foreach ($measurementProfiles as $profile) 
        {
            if($profile->user_id == $user_id)
            {
                $dmProfile = new stdClass();
                $dmProfile->id = $profile->id;
                $dmProfile->name = $profile->name;
                $measurementProfile_array[] = $dmProfile;
            }
        }
        return $measurementProfile_array;
        }
    }

    private function shirtPrice($product)
    {
        $startDate = Carbon::create($product->price->startDate);
        $endDate = Carbon::create($product->price->endDate);
        $product_price = new stdClass();
        if (Carbon::now()->between($startDate, $endDate)) {
            $product_price->price = $product->price->splPrice;
            $product_price->old_price = $product->price->price;
        } else {
            $product_price->price = $product->price->price;
        }
        return $product_price;
    }

    private function shirtPocket($product)
    {
        foreach ($product->attributes as $attr) {
            if ($attr->product_attribute_id == 4) {
                $selected_pocket_value = $attr->product_attribute_value_id;
            }
        }
        $shirtPockets_array = array();
        foreach ($product->attributeSet->attributes as $attribute) {
            if ($attribute->id == 4) {
                foreach ($attribute->productAttributeValues as $value) {
                    if ($value->id == $selected_pocket_value) {
                        $shirtPocket = new stdClass();
                        $shirtPocket->id = $value->id;
                        $shirtPocket->value = $value->value;
                        $shirtPocket->select = 1;
                        $shirtPockets_array[] = $shirtPocket;
                    } else {
                        $shirtPocket = new stdClass();
                        $shirtPocket->id = $value->id;
                        $shirtPocket->value = $value->value;
                        $shirtPocket->select = 0;
                        $shirtPockets_array[] = $shirtPocket;
                    }
                }
            }
        }
        return $shirtPockets_array;
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

    private function listproduct()
    {
        $products = Product::where('user_id', 1)
                            ->where('featured', 1)
                            ->orderBy('id', 'desc')->get();
        $product_array = array();
        foreach ($products as $product) {
            $data = new stdClass();
            // $data = new stdClass();
            $data->name = $this->substrwords($product->name, 68);
            $data->slug = '/product/shirt/' . $product->slug;
            foreach ($product->images as $image) {
                if ($image->position_id == 1) {
                    $data->primary_image = '/images/product/product/' . $image->name;
                } elseif ($image->position_id == 2) {
                    $data->secondary_image = '/images/product/product/' . $image->name;
                }
            }
            if ($product->price->splPrice == null) {
                $data->price = 'RM ' . $product->price->price;
            } else {
                $data->price = '<span>RM ' . $product->price->price . '</span> RM ' . $product->price->splPrice;
            }
            $product_array[] = $data;
            // $product_array[] = $product;
        }
        return $product_array;
    }

    private function substrwords($text, $maxchar, $end = '...')
    {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);
            $output = '';
            $i      = 0;
            while (1) {
                $length = strlen($output) + strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                } else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        } else {
            $output = $text;
        }
        return $output;
    }
}
