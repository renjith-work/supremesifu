<?php

namespace App\Http\Controllers\Admin\Api\Settings\Country;

use App\Models\Settings\Zone;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ZoneController extends Controller
{
    public function getZones(Request $request)
    {
        $data = Zone::where('country_id', $request->id)->get();
        return response()->json($data);
    }
}
