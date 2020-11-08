<?php

namespace App\Http\Controllers\Front\Api\User\Address;

use App\Models\User\Address\UserAddress;
use App\Models\User\Address\UserAddressType; 

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use App\User;
use Auth;
use Validator;



class UserAddressController extends Controller
{
    public function getAllUserAddress(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user_address_array = array();

        return response()->json($user->addresses);
        return response()->json($this->setAddress($user));
    }

    public function getAddress(Request $request)
    {
        $sel_address = UserAddress::where('id', $request->id)->first();

        $address = new stdClass();
        $address->id = $sel_address->id;
        $address->name = $sel_address->name;
        $address->address = $sel_address->address . ', ' . $sel_address->city . ', ' . $sel_address->postcode . ', ' . $sel_address->zone->country->name;
        $address->phone = $sel_address->phoneCode->value . $sel_address->phone;

        return response()->json($address);
    }

    private function setAddress($user){
        $billing_address = NULL;
        $shipping_address = NULL;
        $label = null;
        $address_array = array();
        $other_address_array = array();
        foreach($user->addresses as $u_address)
        {
            if ($u_address->userAddressTypes->isEmpty()) {
                $other_address_array[] = $this->createAddress($u_address, $label);
            }else
            {
                foreach($u_address->userAddressTypes as $addressType)
                {
                    if($addressType->address_type_id == 1){
                        $label = 'Default Billing Address';
                        $billing_address = $this->createAddress($u_address, $label);
                        $address_array['billing_address'] = $billing_address;
                        break;
                    }elseif ($addressType->address_type_id == 2) {
                        $label = 'Default Shippping Address';
                        $shipping_address = $this->createAddress($u_address, $label);
                        $address_array['shipping_address'] = $shipping_address;
                        break;
                    }
                }
            }
        }

        $address_array['others'] = $other_address_array;
        return $address_array;
    }

    private function createAddress($add, $label)
    {
        $address = new stdClass();
        $address->id = $add->id;
        $address->name = $add->first_name.' '.$add->last_name;
        $address->address = $add->address . ', ' . $add->city . ', ' . $add->postcode . ', ' . $add->zone->country->name;
        $address->phone = $add->phoneCode->value.$add->phone;
        $address->label = $label;
        return $address;
    }

    public function saveAddress(Request $request)
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

            $this->saveUserAddressLabel($address->id, $address->user_id, $request);
            return response()->json([ 'success' => 1]);

        } else {
                return response()->json([
                'success' => 0,
                'errors' => $validator->errors()
                ]);
        }
    }

    private function saveUserAddressLabel($address_id, $user_id, $request)
    {
        $input = $request->all();
        if (array_key_exists('billing_address', $input)) {
            $this->deleteUserAddressType($user_id, 1);
            $this->saveUserAddressType($address_id, $user_id, 1);
        }

        if (array_key_exists('shipping_address', $input)) {
            $this->deleteUserAddressType($user_id, 2);
            $this->saveUserAddressType($address_id, $user_id, 2);
        }
    }

    private function saveUserAddressType($address_id, $user_id, $type_id)
    {
        $us_ad_t = new UserAddressType;
        $us_ad_t->user_id = $user_id;
        $us_ad_t->user_address_id = $address_id;
        $us_ad_t->address_type_id = $type_id;
        $us_ad_t->save();
    }

    private function deleteUserAddressType($user_id, $type_id)
    {
        UserAddressType::where('user_id', $user_id)
            ->where('address_type_id', $type_id)
            ->delete();
    }
}
