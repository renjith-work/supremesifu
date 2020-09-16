<?php

namespace App\Http\Controllers\Front\User\Address;

use App\Models\User\Address\UserAddress;       
use App\Models\User\Address\UserAddressType;       
use App\Models\User\Address\PhoneCode;       
use App\Models\Settings\Zone;       
use App\Models\Settings\Country;       

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use stdClass;
use Auth;
use Validator;
use Session;

class UserAddressController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($user = Auth::user()) {
            $user_id = Auth::user()->id;
            $addresses = UserAddress::where('user_id', $user->id)->get();
            // $addresses = array("Volvo", "BMW", "Toyota");
            return view('front.user.address.index')->with('addresses', $addresses);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($user = Auth::user()) {
            $countries = Country::where('status', 1)->get();
            $codes = PhoneCode::all();
            $phoneCodes = $this->phoneCode($codes);

            // return response()->json($phoneCodes);
            return view('front.user.address.create')->with('countries', $countries)->with('phoneCodes', $phoneCodes);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(),
            [
                'name' => 'required|min:3|max:255',
                'email'=>'required|email',
                'phone'=>'required|digits_between:5,15',
                'country' => 'required',
                'zone' => 'required',
                'address' => 'required',
                'city' => 'required',
                'postcode' => 'required'
            ],
            [
                'name.required' => 'Please provide the full name.',
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
            $address->name = $request->name;
            $address->email = $request->email;
            $address->phone_code_id = $request->phoneCode;
            $address->phone = $request->phone;
            $address->zone_id = $request->zone;
            $address->address = $request->address;
            $address->city = $request->city;
            $address->postcode = $request->postcode;
            $address->save();

            $this->saveUserAddressLabel($address->id, $address->user_id, $request);
            Session::flash('success', 'The address has been saved to your profile.');
            return redirect('/user/address');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::where('status', 1)->get();
        $codes = PhoneCode::all();
        $phoneCodes = $this->phoneCode($codes);
        $address = UserAddress::find($id);
        $billing_address = $this->checkBillingAddress($address);
        $shipping_address = $this->checkShippingAddress($address);
        return view('front.user.address.edit')->with('countries', $countries)
                                            ->with('phoneCodes', $phoneCodes)
                                            ->with('address', $address)    
                                            ->with('billing_address', $billing_address) 
                                            ->with('shipping_address', $shipping_address);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3|max:255',
                'email' => 'required|email',
                'phone' => 'required|digits_between:5,15',
                'country' => 'required',
                'zone' => 'required',
                'address' => 'required',
                'city' => 'required',
                'postcode' => 'required'
            ],
            [
                'name.required' => 'Please provide the full name.',
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

            $address = UserAddress::find($id);
            $address->user_id = Auth::user()->id;
            $address->name = $request->name;
            $address->email = $request->email;
            $address->phone_code_id = $request->phoneCode;
            $address->phone = $request->phone;
            $address->zone_id = $request->zone;
            $address->address = $request->address;
            $address->city = $request->city;
            $address->postcode = $request->postcode;
            $address->save();

            $this->saveUserAddressLabel($address->id, $address->user_id, $request);
            Session::flash('success', 'The address has been updated.');
            return redirect('/user/address');
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function phoneCode($codes)
    {
        $phoneCodes = array();
        foreach ($codes as $code) {
            if ($code->country->status == 1) {
                $phoneCode = new stdClass();
                $phoneCode->id = $code->id;
                $phoneCode->value = $code->value;
                $phoneCode->code = $code->code;
                $phoneCodes[] = $phoneCode;
            }
        }
        return $phoneCodes;
    }

    private function saveUserAddressLabel($address_id, $user_id, $request)
    {
        $input = $request->all();
        if(array_key_exists('billing_address', $input))
        {
            $this->deleteUserAddressType($user_id, 1);
            $this->saveUserAddressType($address_id, $user_id, 1);
        }

        if (array_key_exists('shipping_address', $input)) 
        {
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

    private function checkBillingAddress($address)
    {
        $check = UserAddressType::where('user_address_id', $address->id)
                                ->where('address_type_id', 1)
                                ->get();
        if(count($check) > 0)
        {
            $value = 1;
        }else{
            $value = 0;
        }

        return $value;
    }

    private function checkShippingAddress($address)
    {
        $check = UserAddressType::where('user_address_id', $address->id)
                                ->where('address_type_id', 2)
                                ->get();
        if (count($check) > 0) {
            $value = 1;
        } else {
            $value = 0;
        }

        return $value;
    }
}
