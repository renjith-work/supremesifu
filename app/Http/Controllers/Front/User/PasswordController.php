<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Validator;
use Session;

class PasswordController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	return view('front.user.passwordReset')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
                'current-password' => 'required',
				'password' => 'required|same:password',
				'password_confirmation' => 'required|same:password',  
            ],
            [
                'current-password.required' => 'Please enter current password',
    			'password.required' => 'Please enter password',
            ]
         );

    	if ($validator->passes()) {
    		$request_data = $request->All();
			$current_password = Auth::User()->password;           
			if(\Hash::check($request_data['current-password'], $current_password))
			{           
				$user_id = Auth::User()->id;                       
				$obj_user = User::find($user_id);
				$obj_user->password = \Hash::make($request_data['password']);;
				$obj_user->save(); 
				Session::flash('success', 'You have successfully reset your password.');
	            return redirect()->back();
			}
			else
			{   $validator->getMessageBag()->add('current-password', 'Please enter your correct current password');        
				return redirect()->back()->withInput()->withErrors($validator)	;
			}
        }else{
        	return redirect()->back()->withInput()->withErrors($validator)	;
        }
    }
}
