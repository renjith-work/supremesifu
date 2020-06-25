<?php

namespace App\Http\Controllers\Front\Api\Product;

use App\Models\Product\Product;
use App\Models\Product\Fabric\Fabric;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function detail(Request $request)
    {
        // Product Details
        $product = Product::find($request->id);
        $data = array();

        if($product->price->splPrice === NULL){
            $product_price  = $product->price->price;
            $product_oldPrice  = NULL;
        }else{
            $product_price  = $product->price->splPrice;
            $product_oldPrice  = $product->price->price;
        }

        $productImage_array = array();
        $product_image_album = array();
        foreach($product->images as $image)
        {
            if($image->position_id == 1){
                $product_primary_image = $image->name;
            }elseif ($image->position_id == 2) {
                $product_secondary_image = $image->name;
            }else{
                $product_image_album[] = $image->name;
            }
        }

        $productImage_array[] = array(
                                'primary_image' => $product_primary_image,
                                'secondary_image' => $product_secondary_image,
                                'album' => $product_image_album,
        );

        // Fabric Details 
        $fabric = Fabric::find($product->fabric_id);
        $fabricAttributeValue_array = array();
        $fabricAttribute_array = array();

        $fabricAttributes = $fabric->fabricAttributeValues;
        
        foreach ($fabricAttributes as $fabricAttribute) {
            $fabricAttributeValue_array[] = array(
                'attribute_name' => $fabricAttribute->fabricAttribute->name,
                'attribute_value' => $fabricAttribute->value,
            );
        }

        $fabricAttribute_array[] = array(
            'id' => $fabric->id,
            'name' => $fabric->name,
            'class' => $fabric->class->name,
            'image' => $fabric->image,
            'attributes' => $fabricAttributeValue_array,
        );

        $shirtPockets = $this->loadShirtPocket($product);
        $measurementAttributes = $this->measurementAttributes($product);

        $data[] = array(
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product_price,
                    'old_price' => $product_oldPrice,
                    'fabric' => $fabricAttribute_array,
                    'image' => $productImage_array,
                    'pockets' => $shirtPockets,
                    // 'measurementAttributes' => $measurementAttributes,
                    'measurementAttributes' => $product->attributeSet->measurementAttributes,
        );

        return response()->json($data);
    }

    private function loadShirtPocket($product)
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
                        $shirtPockets_array[] = array(
                            'id' => $value->id,
                            'value' => $value->value,
                            'select' => 1
                        );
                    } else {
                        $shirtPockets_array[] = array(
                            'id' => $value->id,
                            'value' => $value->value,
                            'select' => 0
                        );
                    }
                }
            }
        }
        return $shirtPockets_array;
    }

    public function details()
    {
        // Product Details
        $product = Product::find(1);
        $data = array();

        if ($product->price->splPrice === NULL) {
            $product_price  = $product->price->price;
            $product_oldPrice  = NULL;
        } else {
            $product_price  = $product->price->splPrice;
            $product_oldPrice  = $product->price->price;
        }

        $productImage_array = array();
        $product_image_album = array();
        foreach ($product->images as $image) {
            if ($image->position_id == 1) {
                $product_primary_image = $image->name;
            } elseif ($image->position_id == 2) {
                $product_secondary_image = $image->name;
            } else {
                $product_image_album[] = $image->name;
            }
        }

        $productImage_array[] = array(
            'primary_image' => $product_primary_image,
            'secondary_image' => $product_secondary_image,
            'album' => $product_image_album,
        );

        // Fabric Details 
        $fabric = Fabric::find($product->fabric_id);
        $fabricAttributeValue_array = array();
        $fabricAttribute_array = array();

        $fabricAttributes = $fabric->fabricAttributeValues;

        foreach ($fabricAttributes as $fabricAttribute) {
            $fabricAttributeValue_array[] = array(
                'attribute_name' => $fabricAttribute->fabricAttribute->name,
                'attribute_value' => $fabricAttribute->value,
            );
        }

        $fabricAttribute_array[] = array(
            'id' => $fabric->id,
            'name' => $fabric->name,
            'class' => $fabric->class->name,
            'image' => $fabric->image,
            'attributes' => $fabricAttributeValue_array,
        );

        $productAttributes_Array = array();
        foreach ($product->attributes as $attribute) {
            $productAttributes_Array[] = array(
                'name' => $attribute->productAttribute->name,
                'value' => $attribute->value->value
            );
        }

        $shirtPockets = $this->loadShirtPocket($product);
        $measurementAttributes = $this->measurementAttributes($product);

        $data[] = array(
            'name' => $product->name,
            'price' => $product_price,
            'old_price' => $product_oldPrice,
            'fabric' => $fabricAttribute_array,
            'image' => $productImage_array,
            'attributes' => $productAttributes_Array,
            'pockets' => $shirtPockets,
            'monograms' => $product->attributeSet->monograms,
            'measurementAttributes' => $measurementAttributes,
            'measurementAttributes' => $product->attributeSet->measurementAttributes,
        );

        return response()->json($data);
    }

    private function measurementAttributes($product)
    {
        $data = array();
        foreach ($product->attributeSet->measurementAttributes as $attribute) {
            $data[] = array(
                'name' => $attribute->name,
                'code' => $attribute->code,
                'category' => $attribute->measurement_category_id,
                'tutorial' => $attribute->tutorial,
            );
        }
        return $data;
    }
}
