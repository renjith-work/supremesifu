<?php

namespace App\Http\Controllers\Front\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Validator;
use Socialite;
use Session;
use Carbon\Carbon;

class LoginController extends Controller
{   

     public function login()
    {   
        if(Auth::check()){
            return redirect()->back();
        }else{
            return view('front.auth.login');
        }
    }

    public function loginUser(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        else
        {
            $remember = $request->remember;
            $email = $request->email;
            $password = $request->password;

            $user = User::select('id')->where('email', $email)->first();

            if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
                if (Session::has('url.intended')){
                  return redirect(session('url.intended'));
                }else{
                  return redirect('/');
                }
            }else{
                $error =[ 'message' => "Sorry, we couldn't find an account the matches the credentials you provided. You can try and login with another account or try to retrieve your password by clicking this link.",];
                return back()->withInput()->withErrors($error);
            }
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        
        try{
            $user =  Socialite::driver('google')->stateless()->user();
        }catch (\Exception $e) {
            return redirect('/login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $name = $this->getFirstLastNames($user->name);
            // return $name['first_name'];
            
            $newUser                  = new User;
            $newUser->fname           = $name['first_name'];
            $newUser->lname           = $name['last_name'];
            $newUser->email           = $user->email;
            $newUser->email_verified_at  = Carbon::now();
            $newUser->provider       = 'Google';
            $newUser->provider_id       = $user->id;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect()->to('/user/dashboard');
        }
        return redirect()->to('/');
    }

        public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {

        try{
            $user =  Socialite::driver('facebook')->user();
        }catch (\Exception $e) {
            return redirect('/login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $name = $this->getFirstLastNames($user->name);
            // return $name['first_name'];
            
            $newUser                  = new User;
            $newUser->fname           = $name['first_name'];
            $newUser->lname           = $name['last_name'];
            $newUser->email           = $user->email;
            $newUser->email_verified_at  = Carbon::now();
            $newUser->provider       = 'Google';
            $newUser->provider_id       = $user->id;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect()->to('/user/dashboard');
        }
        return redirect()->to('/');
    }

    public function getFirstLastNames($fullName)
    {
        $parts = array_values(array_filter(explode(" ", $fullName)));

        $size = count($parts);

        if(empty($parts)){
            $result['first_name']   = NULL;
            $result['last_name']    = NULL;
        }

        if(!empty($parts) && $size == 1){
            $result['first_name']   = $parts[0];
            $result['last_name']    = NULL;
        }

        if(!empty($parts) && $size >= 2){
            $result['first_name']   = $parts[0];
            $result['last_name']    = $parts[1];
        }

        return $result;
    }
}
