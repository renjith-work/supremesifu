<?php

namespace App\Http\Controllers\Front\Product\Product;

use App\Models\Product\Product;
use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Monogram;
use App\Models\Product\ProductMonogram;
use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductAttributeValueSave;
use App\Models\Product\Design\ProductDesign;
use App\Models\Product\ProductPrice;
use App\Models\Product\Weight\ProductWeight;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use Session;
use Auth;
use Cart;
use Carbon\Carbon;

class CreateShirtController extends Controller
{
    public function createShirt(Request $request)
    {
        if ($user = Auth::user()) {
            
            $user_id = Auth::user()->id;
            $input = $request->all();
            $design = ProductDesign::find($input['design']);
            $fabric = Fabric::find($input['fabric']);

            $product = new Product;
            $product->name = $fabric->name.' ' .$design-> name . '-'. $user_id . '-' . time();
            $product->user_id = $user_id;
            $product->product_design_id = $design->id;
            $product->product_attribute_set_id = $design->product_attribute_set_id;
            $product->description = $design->description;
            $product->summary = $design->summary;
            $product->fabric_id = $input['fabric'];
            $product->tax_class_id = $design->tax_class_id;
            $product->pageTitle = $design->pageTitle;
            $product->metatag = $design->metatag;
            $product->metadescp = $design->metadescp;
            $product->save();
            
            $this->attributeSave($product->id, $input['shirt-pocket'], $design->attributes);
            $this->priceSave($input, $product->id);
            $this->weightSave($input, $product->id, $design);
            $this->monogramSave($input, $product->id);

            $defaultMeasurementProfile = $this->defaultMeasurementProfile($product);
            $userMeasurementProfile = $this->userMeasurementProfile($product);
            
            return view('front.product.custom.shirt.measurement.index')->with('product', $product->id)->with('userMeasurementProfile', $userMeasurementProfile)->with('defaultMeasurementProfile', $defaultMeasurementProfile);

        } else {
            session(['url.intended' => '/custom-shirt/fabric/class']);
            return redirect('/login');
        }
    }

    private function monogramSave($input, $product_id)
    {
        $monograms = Monogram::where('product_attribute_set_id', 1)->get();
        foreach ($monograms as $monogram) {
            if (array_key_exists($monogram->code, $input)) {
                if (isset($input[$monogram->code])) {
                    $productMonogram = new ProductMonogram;
                    $productMonogram->product_id = $product_id;
                    $productMonogram->monogram_id = $monogram->id;
                    $productMonogram->value = $input[$monogram->code];
                    $productMonogram->save();
                }
            }
        }
    }

    private function weightSave($input, $product_id, $design)
    {
        $weight = new ProductWeight;
        $weight->product_id = $product_id;
        $weight->inventory_unit_id = $design->weight->inventory_unit_id;
        $weight->weight = $design->weight->weight;
        $weight->save();
        return $weight;
    }

    private function priceSave($input, $product_id)
    {
        $productPrice = new ProductPrice;
        $productPrice->product_id = $product_id;
        $productPrice->price = $input['price'];
        $productPrice->save();
        return $productPrice;
    }

    private function attributeSave($productId, $pocket, $designAttributes)
    {
        /*
            Get the attribute of the the design and save it on to the new product attribute.
        */
        $productAttributes = array();
        foreach($designAttributes as $attribute) 
        {
            if($attribute->product_attribute_id == 4){ //Setting the pocket value from the selection
                $productAttributes[] = array(
                    'product_id' => $productId,
                    'product_attribute_id' => $attribute->product_attribute_id,
                    'product_attribute_value_id' => $pocket, //Input the recorded pocket selection

                );
            }else{
                $productAttributes[] = array(
                    'product_id' => $productId,
                    'product_attribute_id' => $attribute->product_attribute_id,
                    'product_attribute_value_id' => $attribute->product_attribute_value_id,

                );
            }
            
        }
        ProductAttributeValueSave::insert($productAttributes);
        return $productAttributes;
    }

    private function defaultMeasurementProfile($product)
    {
        $measurementProfiles = $product->attributeSet->measurementProfiles;
        $measurementProfile_array = array();
        foreach ($measurementProfiles as $profile) {
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
            foreach ($measurementProfiles as $profile) {
                if ($profile->user_id == $user_id) {
                    $dmProfile = new stdClass();
                    $dmProfile->id = $profile->id;
                    $dmProfile->name = $profile->name;
                    $measurementProfile_array[] = $dmProfile;
                }
            }
            return $measurementProfile_array;
        }
    }
}
