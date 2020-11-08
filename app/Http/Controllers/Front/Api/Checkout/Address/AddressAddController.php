<?php

namespace App\Http\Controllers\Front\Api\Checkout\Address;

use App\Models\User\Address\UserAddress;
use App\Models\User\Address\UserAddressType; 

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use App\User;
use Auth;
use Validator;

class AddressAddController extends Controller
{
    public function save(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required|min:3|max:255',
                'last_name' => 'required|min:1|max:255',
                'email' => 'required|email',
                'phone' => 'required|digits_between:5,15',
                'country' => 'required',
                'zone' => 'required',
                'address' => 'required',
                'city' => 'required',
                'postcode' => 'required'
            ],
            [
                'first_name.required' => 'Please provide the first name.',
                'last_name.required' => 'Please provide the last name.',
                'email.required' => 'Please provide an email address.',
                'email.email' => 'Please provide a valid email address.',
                'phone.required' => 'Please provide a phone number.',
                'phone.digits_between' => 'Please enter a valid phone number.',
                'country.required' => 'Please select a country.',
                'zone.required' => 'Please select a zone.',
                'address.required' => 'Please provide an address.',
                'city.required' => 'Please provide a city.',
                'postcode.required' => 'Please provide a post code.',
            ]
        );
        if ($validator->passes()) {

            $address = new UserAddress;
            $address->user_id = Auth::user()->id;
            $address->first_name = $request->first_name;
            $address->last_name = $request->last_name;
            $address->email = $request->email;
            $address->phone_code_id = $request->phoneCode;
            $address->phone = $request->phone;
            $address->zone_id = $request->zone;
            $address->address = $request->address;
            $address->city = $request->city;
            $address->country_id = $request->country;
            $address->postcode = $request->postcode;
            $address->save();

            return response()->json([
                                        'success' => 1,
                                        'address' => $this->returnAddress($address),
                                    ]);
        } else {
            return response()->json([
                'success' => 0,
                'errors' => $validator->errors()
            ]);
        }
    }

    private function returnAddress($sel_address)
    {
        $address = new stdClass();
        $address->id = $sel_address->id;
        $address->name = $sel_address->first_name . ' ' . $sel_address->last_name;
        $address->address = $sel_address->address . ', ' . $sel_address->city . ', ' . $sel_address->postcode . ', ' . $sel_address->zone->country->name;
        $address->phone = $sel_address->phoneCode->value . $sel_address->phone;
        return $address;
    }
}
