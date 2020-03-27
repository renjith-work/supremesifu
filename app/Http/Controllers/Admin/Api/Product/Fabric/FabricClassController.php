<?php

namespace App\Http\Controllers\Admin\Api\Product\Fabric;

use App\Models\Product\Fabric\FabricClass;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FabricClassController extends Controller
{
    public function load()
    {
        $fabricclasses = FabricClass::all();
        return response()->json($fabricclasses);
    }
}
