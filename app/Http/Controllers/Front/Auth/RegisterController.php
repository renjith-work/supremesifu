<?php

namespace App\Http\Controllers\Front\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Validator;
use App\User;
use Session;
use Auth;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            return redirect('/');
        }else{
            $attributeNames = array(
                'fname' => 'first name',
                'lname' => 'last name'
            );

            $validator = Validator::make($request->all(),[
                'fname'=>'required|max:120',
                'lname'=>'required|max:120',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:6|confirmed',
                'password_confirmation'=>'required_with:password|same:password'
            ],
            [
                'password.confirmed' => 'The passwords entered do not matach.',
                'fname.required' => 'Please provide a first name.',
                'lname.required' => 'Please provide a last name.',
                'email.required' => 'Please provide a valid email.',
                'password.required' => 'Please provide a password of minimum 6 characters.',
            ]);

            $validator->setAttributeNames($attributeNames);

            if ($validator->passes()) {
                $user = new User;
                $user->fname = $request->fname;
                $user->lname = $request->lname;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();

                $roles = [11];
                if (isset($roles)) {
                    foreach ($roles as $role) {
                        $role_r = Role::where('id', '=', $role)->firstOrFail();            
                        $user->assignRole($role_r); //Assigning role to user
                    }
                }  
                $user->sendEmailVerificationNotification();
                Auth::login($user);   

                Session::flash('success', 'The user was successfully registered.');
                return redirect()->route('verification.notice');
            }else{
                return redirect()->back()->withInput()->withErrors($validator);
            }
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
        //
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
        //
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

    public function register()
    {   
        if(Auth::check()){
            return redirect('/');
        }else{
            return view('front.auth.register');
        }
    }
}
