<?php

namespace App\Http\Controllers\Front\Product\Fabric;

use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Fabric\FabricClass;
use App\Models\Product\Fabric\FabricAttribute;
use App\Models\Product\Fabric\FabricAttributeValue;
use App\Models\Brand;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FabricController extends Controller
{
    public function classList(){
        $classes = FabricClass::orderBy('id', 'asc')->get();
        return view('front.product.custom.shirt.fabric.class')->with('classes', $classes);
    }

    public function listFabrics($id){
        $fabrics = Fabric::where('fabric_class_id', $id)->get();
        $class = FabricClass::find($id);
        return view('front.product.custom.shirt.fabric.index')->with('fabrics', $fabrics)->with('class', $class);
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
