<?php

namespace App\Http\Controllers\Front\Product\Design\Shirt;

use App\Models\Product\Design\ProductDesign;
use App\Models\Product\Design\ProductDesignAttributeValueSave;
use App\Models\Product\Monogram;
Use App\Models\Product\Fabric\Fabric;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use Carbon\Carbon;

class DesignController extends Controller
{
    public function listshirtDesigns($id)
 	{
        $attr = 1; //Attribute Set for shirt.
        $data = new stdClass();
        $data->fabric = $this->getFabric($id, $attr);
        $data->designs = $this->getDesigns($attr);

        // return response()->json($data);
        return view('front.product.custom.shirt.design.index')->with('data', $data);
    }

    private function getDesigns($attr)
    {
        $selDesigns = ProductDesign::where('product_attribute_set_id', $attr)->orderBy('id', 'asc')->get();
        $designs_array = array();
        foreach($selDesigns as $selDesign)
        {
            $design = new stdClass();
            $design->id = $selDesign->id;
            $design->name = $selDesign->name;
            foreach ($selDesign->images as $image) {
                if ($image->position_id == 1) {
                    $design->primary_image = '/images/product/design/' . $image->name;
                } elseif ($image->position_id == 2) {
                    $design->secondary_image = '/images/product/design/' . $image->name;
                }
            }
            $design->attributes = $this->designAttributes($selDesign->id);
            $design->summary = $this->substrwords($selDesign->summary, 80);
            $designs_array[] = $design;
        }
        return $designs_array;
        return $selDesigns;
    }

    private function designAttributes($id)
    {
        $attr_values = ProductDesignAttributeValueSave::where('product_design_id', $id)->get();
        $attr_array = array();
        foreach($attr_values as $attr_value)
        {
            $data = new stdClass();
            $data->name = $attr_value->productAttribute->name;
            $data->value = $attr_value->value->value;
            $attr_array[] = $data;
        }
        return $attr_array;
    }

    private function getFabric($id, $attr)
    {
        $fabric = Fabric::find($id);

        $data = new stdClass();
        $data->id = $fabric->id;
        $data->name = $fabric->name;
        $data->price = $this->fabricPrice($fabric, $attr);
        return $data;
    }

    private function fabricPrice($fabric, $attr)
    {
        foreach ($fabric->prices as $price) {
            if ($price->product_attribute_set_id == $attr) {
                $startDate = Carbon::create($price->startDate);
                $endDate = Carbon::create($price->endDate);
                $fabric_price = new stdClass();
                if (Carbon::now()->between($startDate, $endDate)) {
                    $fabric_price->price = $price->splPrice;
                    $fabric_price->old_price = $price->price;
                } else {
                    $fabric_price->price = $price->price;
                    $fabric_price->old_price = null;
                }
            }
        }
        return $fabric_price;
    }
    

 	public function load(Request $request)
    {
        $productDesign = ProductDesign::find($request->id);
        $productFabric = Fabric::find($request->fabric);

        $design = new stdClass();
        $design->id = $productDesign->id;
        $design->name = $productDesign->name;
        $design->price = $this->price($productFabric, $productDesign->product_attribute_Set_id);
        $design->pockets = $this->pocket($productDesign);
        $design->images = $this->images($productDesign);
        $design->monograms = $this->monograms($productDesign);
        return response()->json($design);
    }

    private function price($fabric, $attrSet)
    {
        foreach($fabric->prices as $price)
        {
            if($price->product_atrribute_set_id == $attrSet)
            {
                $startDate = Carbon::create($price->startDate);
                $endDate = Carbon::create($price->endDate);
                $fabric_price = new stdClass();
                if (Carbon::now()->between($startDate, $endDate)) {
                    $fabric_price->price = $price->splPrice;
                    $fabric_price->old_price = $price->price;
                } else {
                    $fabric_price->price = $price->price;
                    $fabric_price->old_price = null;
                }
                return $fabric_price;
            }
        }
    }

    private function pocket($design)
    {
        foreach ($design->attributes as $attr) {
            if ($attr->product_attribute_id == 4) {
                $selected_pocket_value = $attr->product_attribute_value_id;
            }
        }
        
        $shirtPockets_array = array();
        foreach ($design->attributeSet->attributes as $attribute) {
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

    private function images($design)
    {
        $image = new stdClass();
        $image_album = array();
        foreach($design->images as $item)
        {
            if($item->position_id == 1)
            {
                $image->primary = $item->name;
            }elseif ($item->position_id == 2) {
                $image->secondary = $item->name;
            }else{
                $image_album[] = $item->name;
            }
        }
        $image->album = $image_album;
        return $image;
    }

    private function monograms($design)
    {
        $monograms = Monogram::where('product_attribute_set_id', $design->product_attribute_set_id)->get();
        return $monograms;
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
