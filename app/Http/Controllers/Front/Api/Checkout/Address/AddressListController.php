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

class AddressListController extends Controller
{
    public function listAll(Request $request)
    {
        return response()->json($this->allAddresses());
    }

    private function allAddresses()
    {
        $user = Auth::user();
        $address_array = array();
        foreach($user->addresses as $address)
        {
            $address_array[] = $this->createAddress($address);
        }
        return $address_array;
    }

    private function createAddress($add)
    {
        $address = new stdClass();
        $address->id = $add->id;
        $address->name = $add->first_name . ' ' . $add->last_name;
        $address->address = $add->address . ', ' . $add->city . ', ' . $add->postcode . ', ' . $add->zone->country->name;
        $address->phone = $add->phoneCode->value . $add->phone;
        $address->label = $this->setLabel($add);
        return $address;
    }

    private function setLabel($address)
    {
        $label_array = array();
        $address_labels = UserAddressType::where('user_address_id', $address->id)->get();
        foreach($address_labels as $address_label)
        {
            $label = new stdClass();
            $label->id = $address_label->address_type_id;
            $label->name = $address_label->type->name;
            $label_array[] = $label;
        }        
        return $label_array;
    }

    public function getAddress(Request $request)
    {
        $sel_address = UserAddress::where('id', $request->id)->first();

        $address = new stdClass();
        $address->id = $sel_address->id;
        $address->name = $sel_address->first_name . ' ' . $sel_address->last_name;
        $address->address = $sel_address->address . ', ' . $sel_address->city . ', ' . $sel_address->postcode . ', ' . $sel_address->zone->country->name;
        $address->phone = $sel_address->phoneCode->value . $sel_address->phone;

        return response()->json($address);
    }

    public function check(Request $request)
    {
        $user = Auth::user();
        if(count($user->addresses) < 1)
        {
            $data = 1;
        }else{
            $data = 2;
        }
        return response()->json($data);
    }
}
