<?php

namespace App\Http\Controllers\Front\Api\User\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use App\Models\Settings\Country;

class CountryController extends Controller
{
    public function getCountries()
    {
        $countries = Country::where('status', 1)->get();
        return response()->json($countries);
    }
}
