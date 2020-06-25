<?php

namespace App\Http\Controllers\Front\Api\Monogram;

use App\Models\Product\Monogram;
use App\Models\Product\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonogramController extends Controller
{
    public function loadMonograms(Request $request)
    {
        $product = Product::find($request->id);
        $monograms = $product->attributeSet->monograms;
        return response()->json($monograms);
    }

    public function loadMonogramz()
    {
        $product = Product::find(1);
        $monograms = $product->attributeSet->monograms;
        return response()->json($monograms);
    }
}
