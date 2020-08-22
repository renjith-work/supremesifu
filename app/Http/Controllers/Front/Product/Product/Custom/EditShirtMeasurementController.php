<?php

namespace App\Http\Controllers\Front\Product\Product\Custom;

use App\Models\Product\Product;
use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Monogram;
use App\Models\Product\ProductMonogram;
use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductAttributeValueSave;
use App\Models\Product\Design\ProductDesign;
use App\Models\Product\ProductPrice;
use App\Models\Product\Weight\ProductWeight;
use App\Models\Measurement\MeasurementAttribute;
use App\Models\Measurement\UserMeasurementProfile;
use App\Models\Measurement\UserMeasurementProfileValue;
use App\Models\Measurement\UserProductMeasurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use Session;
use Auth;
use Cart;
use Carbon\Carbon;

class EditShirtMeasurementController extends Controller
{
    public function editShirt(Request $request)
    {
        if ($user = Auth::user()) {
            
            $user_id = Auth::user()->id;
            $input = $request->data;
            
            $product = Product::find($input['product']);
            
            if($user_id == $product->user_id)
            {
                $design = ProductDesign::find($product->product_design_id);
                $fabric = Fabric::find($input['fabric']);
                $product->fabric_id = $fabric->id;
                $product->save();
                $this->monogramSave($input, $product->id);
                $this->priceSave($input, $product->id, $product->price->id);
                $this->attributeSave($product->id, $input['shirt-pocket'], $design->attributes);
                
                $measurementResponse = $this->checkMeasurementProfile($input);
                $this->saveProductMeasurement($input, $product->id);
                $this->updateCart($product, $input['quantity']);

                $data = new stdClass();
                $data->product = $product;
                $data->measurementResponse = $measurementResponse;

                return response()->json($data);

            }else{
                session(['url.intended' => '/custom-shirt/fabric/class']);
                return redirect('/login');
            }

        } else {
            session(['url.intended' => '/custom-shirt/fabric/class']);
            return redirect('/login');
        }
    }

    private function updateCart($product, $quantity)
    {
        Cart::remove($product->id);
        Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => $quantity,
            'price' => $product->price->price,
            'attributes' => array(
                'fabric' => $product->fabric->name,
                'user'   => $product->user_id,
                'images' => $product->design->images
            )
        ));
    }

    private function checkMeasurementProfile($input)
    {
        $response_value = 0;
        $profile_id = $input['measurement_profile'];
        $profile_values = UserMeasurementProfileValue::where('u_mp_id', $profile_id)->get();
        foreach ($profile_values as $profile_value) {
            if ($profile_value->value != $input[$profile_value->measurementAttribute->code]) {
                $response_value++;
            }
        }
        return $response_value;
    }

    private function saveProductMeasurement($input, $product)
    {
        UserProductMeasurement::where('product_id', $product)->delete();
        $product_measeurement_array = array();
        $attributes = MeasurementAttribute::where('product_attribute_set_id', 1)->get();
        foreach ($attributes as $attribute) {
            if (array_key_exists($attribute->code, $input)) {
                if (isset($input[$attribute->code])) {
                    $product_measeurement_array[] = array(
                        'ump_id' => $input['measurement_profile'],
                        'product_id' => $product,
                        'm_at_id' => $attribute->id,
                        'value' => $input[$attribute->code]
                    );
                }
            }
        }
        UserProductMeasurement::insert($product_measeurement_array);
        return $product_measeurement_array;
    }

    private function monogramSave($input, $product_id)
    {
        ProductMonogram::where('product_id', $product_id)->delete();
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

    private function priceSave($input, $product_id, $id)
    {
        $productPrice = ProductPrice::find($id);
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
        ProductAttributeValueSave::where('product_id', $productId)
                                    ->where('product_attribute_id', 4)
                                    ->delete();
        $productAttributes = array();
        foreach ($designAttributes as $attribute) {
            if ($attribute->product_attribute_id == 4) { //Setting the pocket value from the selection
                $productAttributes[] = array(
                    'product_id' => $productId,
                    'product_attribute_id' => $attribute->product_attribute_id,
                    'product_attribute_value_id' => $pocket, //Input the recorded pocket selection

                );
            } else {
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
}
