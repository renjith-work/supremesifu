<?php

namespace App\Http\Controllers\Front\Api\Measurement;

use App\Models\Product\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeasurementAttributeController extends Controller
{

    public function loadAttributes(Request $request)
    {
        $product = Product::find($request->id);
        $attributes = $product->attributeSet->measurementAttributes;
        return response()->json($attributes);
    }
}
