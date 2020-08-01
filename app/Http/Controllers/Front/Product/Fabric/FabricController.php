<?php

namespace App\Http\Controllers\Front\Product\Fabric;

use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Fabric\FabricClass;
Use App\Models\Product\ProductCategory;
use App\Models\Product\Fabric\FabricAttribute;
use App\Models\Product\Fabric\FabricAttributeValue;
use App\Models\Brand;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use Carbon\Carbon;

class FabricController extends Controller
{
    public function classList(){
        $classes = FabricClass::orderBy('id', 'asc')->get();
        return view('front.product.custom.shirt.fabric.class')->with('classes', $classes);
    }

    public function listFabrics($id){
        $category = ProductCategory::find(3);
        $fabrics = array();
        foreach($category->fabrics as $fabric)
        {
            if($fabric->fabric_class_id == $id)
            {
                $data = new stdClass();
                $data->id = $fabric->id;
                $data->name = $fabric->name;
                $data->description = $fabric->description;
                $data->image = $fabric->image;
                $data->brand_id = $fabric->brand_id;
                $data->price = $this->price($fabric);
                $data->attributes = $this->attributes($fabric);
                $fabrics[] = $data;
            }
        }
        $class = FabricClass::find($id);
        return view('front.product.custom.shirt.fabric.index')->with('fabrics', $fabrics)->with('class', $class);
    }

    private function attributes($fabric)
    {   $attributes = array();
        foreach($fabric->fabricAttributeValues as $attribute)
        {
            $attributes[] = $attribute->value;

        }
        return $attributes;
    }

    private function price($fabric)
    {   
        foreach ($fabric->prices as $price) {
            if ($price->product_attribute_set_id == 1) {
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

    public function find(Request $request){
        $fabric_class_id = $request->id;
      $fabrics = Fabric::where('fabric_class_id', $fabric_class_id)
                                       ->orderBy('id', 'asc')
                                       ->get();

      $attributes = [];                           
      foreach($fabrics as $fabric){
        
      $attributes = [];
      foreach($fabric->fabricAttributeValues as $attribute){
          $attributes[] = $attribute->value;
          // $attributes[] = array(
          //                   $attribute->fabricAttribute->name => $attribute->value,
          //                 );
      }

      $str = implode (", ", $attributes);

      $data[] = array(
                  'id' => $fabric->id,
                  'name' => $fabric->name,
                  'description' => $fabric->description,
                  'price' => $fabric->price,
                  'image' => $fabric->image,
                  'class' => $fabric->class->name,
                  'attributes' => $str
                );

      unset($attributes);
    }

        return response()->json($data);                       
    }

    public function fabricDetails(Request $request){
        $fabric = Fabric::find($request->id);
        $data2 = array();
        $attributes = $fabric->fabricAttributeValues;
        foreach($attributes as $attribute){
            $data2[] = array(
                        't1' => $attribute->fabricAttribute->name,
                        't2' => $attribute->value,
            );
        }

        $data[] = array(
                  'id' => $fabric->id,  
                  'name' => $fabric->name,  
                  'class' => $fabric->class->name,  
                  'image' => $fabric->image,
                  'attributes' => $data2 
        );
        unset($data2);
        return response()->json($data);
    }
}
