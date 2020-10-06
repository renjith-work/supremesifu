<?php

namespace App\Http\Controllers\Front\Api\User\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use stdClass;
use App\User;
use Auth;
use App\Models\User\Address\UserAddress;
use App\Models\User\Address\UserAddressType; 

class UserAddressController extends Controller
{
    public function getAllUserAddress(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user_address_array = array();

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
        $address->name = $add->name;
        $address->address = $add->address . ', ' . $add->city . ', ' . $add->postcode . ', ' . $add->zone->country->name;
        $address->phone = $add->phoneCode->value.$add->phone;
        $address->label = $label;
        return $address;
    }
}
