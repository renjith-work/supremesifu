<?php

namespace App\Http\Controllers\Admin\Api\Product\Fabric;

use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Fabric\FabricClass;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FabricController extends Controller
{
    public function findFabric(Request $request)
    {
    	$data = Fabric::where('fabric_class_id', $request->id)->get();
        return response()->json($data);
    }
}
