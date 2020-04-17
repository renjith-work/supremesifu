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
    	$data = Fabric::where('fabric_class_id', $request->id)->get();
        return response()->json($data);
    }

    public function pdCategory(Request $request)
    {
        $category = ProductCategory::find($request->id);
        return response()->json($category->productCategories());
    }
}
