<?php

namespace App\Http\Controllers\Front\Product\Product;

use App\Models\Product\Product;
use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Monogram;
use App\Models\Product\ProductMonogram;
use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductAttributeValueSave;
use App\Models\Product\Design\ProductDesign;
use App\Models\Measurement\UserMeasurementProfile;
use App\Models\Measurement\MeasurementAttribute;
use App\Models\UMProfileValue;
use App\Models\Measurement\UserProductMeasurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use stdClass;
use Session;
use Auth;
use Cart;
use Carbon\Carbon;

class EditProductController extends Controller
{
    public function edit($id)
    {
        $product = Product::find($id);
        $design = ProductDesign::find($product->product_design_id);
        $shirtPockets = $this->shirtPocket($product);
        $productPrice = $this->shirtPrice($product);
        $monograms = $this->productMonogram($product);
        $defaultMeasurementProfile = $this->defaultMeasurementProfile($product);
        $userMeasurementProfile = $this->userMeasurementProfile($product);
        $productMeasurements = $this->productMeasurements($product);
        $productMeasurementProfile = $this->productMeasurementProfile($product);

        // return response()->json($productMeasurementProfile);
        return view('front.product.shirt.edit')
                ->with('product', $product)
                ->with('productPrice', $productPrice)
                ->with('shirtPockets', $shirtPockets)
                ->with('userMeasurementProfile', $userMeasurementProfile)
                ->with('defaultMeasurementProfile', $defaultMeasurementProfile)
                ->with('monograms', $monograms)
                ->with('design', $design)
                ->with('productMeasurements', $productMeasurements)
                ->with('productMeasurementProfile', $productMeasurementProfile);
    }

    private function productMeasurementProfile($product)
    {
        $measurements = UserProductMeasurement::where('product_id', $product->id)->get();
        $measurementProfileId = null;
        foreach($measurements as $measurement)
        {
            $measurementProfileId = $measurement->ump_id;
        }
        return $measurementProfileId;
    }

    private function productMeasurements($product)
    {
        $measurements = UserProductMeasurement::where('product_id', $product->id)->get();
        $measurement_attributes = MeasurementAttribute::where('product_attribute_set_id', $product->product_attribute_set_id)->get();
        $measurement_array = array();
        $item_value = null; 
        foreach ($measurement_attributes as $attribute)
        {
            foreach ($measurements as $measurement) 
            {
                if($attribute->id == $measurement->m_at_id)
                {
                    $item_value = $measurement->value;
                    break;
                }else{
                    $item_value = null;
                }
            }

            $item = new stdClass();
            $item->category = $attribute->measurement_category_id;
            $item->name = $attribute->name;
            $item->tutorial_id = $attribute->tutorial_id;
            $item->code = $attribute->code;
            $item->value = $item_value;
            $measurement_array[] = $item;
            unset($item_value);
        }
        return $measurement_array;
    }

    private function productMonogram($product)
    {
        $attribute_monograms = Monogram::where('product_attribute_set_id', $product->product_attribute_set_id)->get();
        $product_monograms = ProductMonogram::where('product_id', $product->id)->get();

        $monogram_array = array();
        $item_value = null; 

        foreach ($attribute_monograms as $monogram) {
            foreach ($product_monograms as $product_monogram) {
                if($monogram->id == $product_monogram->monogram_id)
                {
                    $item_value = $product_monogram->value;
                    break;
                }else{
                    $item_value = null;
                }
            }

            $item = new stdClass();
            $item->name = $monogram->name;
            $item->tutorial_id = $monogram->tutorial_id;
            $item->code = $monogram->code;
            $item->letter = $monogram->letter;
            $item->value = $item_value;
            $monogram_array[] = $item;
        }
        return $monogram_array;
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
