<?php

namespace App\Http\Controllers\Admin\Api\Product\Tax;

use App\Models\Product\Tax\TaxZone;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxZoneController extends Controller
{
    public function getZones(Request $request)
    {
        $data = TaxZone::where('tax_country_id', $request->id)->get();
        return response()->json($data);
    }

}
