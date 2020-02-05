<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;
use Auth;
use Validator;
use Session;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(15);
        return view('admin.auth.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.auth.users.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'fname'=>'required|max:120',
            'lname'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required_with:password|same:password'
        ],
        [
            'password.confirmed' => 'The passwords entered do not matach.'
        ]);

        if ($validator->passes()) {
            $user = new User;
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->email_verified_at = Carbon::now();
            $user->password = Hash::make($request->password);
            $user->save();
            if (isset($request->roles)) {
                foreach ($request->roles as $role) {
                    $role_r = Role::where('id', '=', $role)->firstOrFail();            
                    $user->assignRole($role_r); //Assigning role to user
                }
            }  
            Session::flash('success', 'The data was successfully inserted.');
            return redirect()->route('admin.auth.users.index');
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
        return redirect('/admin/auth/users'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles
        return view('admin.auth.users.edit', compact('user', 'roles')); //pass user and roles data to view

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(),[
            'fname'=>'required|max:120',
            'lname'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'sometimes|nullable|min:6|confirmed',
            'password_confirmation'=>'sometimes|required_with:password|same:password'
        ],
        [
            'password.confirmed' => 'The passwords entered do not matach.'
        ]);

        if ($validator->passes()) {
            $user = User::findOrFail($id); 
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->email_verified_at = Carbon::now();
            if(!is_null(request('password'))) {
                $user->password = Hash::make($request->password);
            }    
            $user->save();
            
            if (isset($request->roles)) {        
            $user->roles()->sync($request->roles);  //If one or more role is selected associate user to roles          
            }        
            else {
                $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            } 

            Session::flash('success', 'The data was successfully updated.');
            return redirect()->route('admin.auth.users.index');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
    //Find a user with a given id and delete
        $user = User::findOrFail($id); 
        $user->delete();

        return redirect()->route('admin.auth.users.index')
            ->with('flash_message',
             'User successfully deleted.');
    }

    public function delete($id) {
    //Find a user with a given id and delete
        $user = User::findOrFail($id); 
        $user->delete();
        $user->roles()->detach();
        
        Session::flash('success', 'The data was successfully updated.');
        return redirect()->route('admin.auth.users.index');
    }

    public function AuthRouteAPI(Request $request){
        return $request->user();
    }
}
