<?php

namespace App\Http\Controllers\Front\Product;

use App\Models\Product\ProductDesign;
use App\Models\Measurement\UserMeasurementProfile;
use App\Models\Measurement\MeasureProfileProductAttributeValue;

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

    public function jso($id)
    {
        // $product = ProductDesign::find($id);
        $product = ProductDesign::find($id)->with('attributeValues')->first();
        $mprofiles = UserMeasurementProfile::where('product_category_id', $product->product_category_id)->pluck('id'); 

        $productAttributes = array();
        foreach($product->attributeValues as $value)
        {
            $productAttributes[] = $value->product_attribute_value_id;            
        }


        $combData = MeasureProfileProductAttributeValue::all();


        $sortProfiles = array();
        foreach($productAttributes as $value) {

            $tmp_arr = MeasureProfileProductAttributeValue::where('product_attribute_value_id', $value)->pluck("mp_id");;
            // print_r($tmp_arr->toArray());exit;
            $tmp_arr_sort = array_merge($sortProfiles, $tmp_arr->toArray());
        }

        $sortProfiles = array_unique($tmp_arr_sort);
        $sortedMeasurementProfiles = array(); 
        foreach($sortProfiles as $sortProfile)
        {
            $sortedMeasurementProfiles[] = UserMeasurementProfile::where('id', $sortProfile)->get();
        }

        return response()->json($sortedMeasurementProfiles);

    }
}
