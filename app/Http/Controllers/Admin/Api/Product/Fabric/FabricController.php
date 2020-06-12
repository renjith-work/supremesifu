<?php

namespace App\Http\Controllers\Admin\Api\Product\Fabric;

use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Fabric\FabricClass;
use App\Models\Product\ProductCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FabricController extends Controller
{
    public function findFabric(Request $request)
    {
        $cat_ids = $request->cats;

        $fabrics_array = array();
        foreach ($cat_ids as $cat_id) {
            $category = ProductCategory::find($cat_id);
            foreach ($category->fabrics as $fab) {
                $fabrics_array[] = array(
                    'id' => $fab->id,
                    'name' => $fab->name,
                    'class' => $fab->fabric_class_id,
                );
            }
        }

        $fabrics_array = array_map("unserialize", array_unique(array_map("serialize", $fabrics_array)));
        $data = array();
        foreach ($fabrics_array as $fabric) {
            if ($fabric['class'] == $request->id)
            $data[] = array(
                'id' => $fabric['id'],
                'name' => $fabric['name']
            );
        }

        return response()->json($data);
    }

    public function pdCategory(Request $request)
    {
        $category = ProductCategory::find($request->id);
        return response()->json($category->productCategories());
    }
}
