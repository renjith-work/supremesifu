<?php

namespace App\Http\Controllers\Front\Api\User\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use App\Models\User\Address\PhoneCode;

class PhoneCodeController extends Controller
{
    public function getCode(Request $request)
    {
        $code = PhoneCode::where('country_id', $request->id)->first();
        return response()->json($code);
    }   
}
