<?php

namespace App\Http\Controllers\Front\User\Address;

use App\Models\Settings\Zone;
use App\Models\Settings\Country;  

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class CountryController extends Controller
{
    public function getZones(Request $request)
    {
        if ($user = Auth::user()) {
            $zones = Zone::where('country_id', $request->id)->get();
            return response()->json($zones);
        }else{
            return response()->json("please login to continue");
        }
    }
}
