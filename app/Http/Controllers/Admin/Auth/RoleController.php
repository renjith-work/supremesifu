<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Validator;
use Session;

class RoleController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']);//isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $roles = Role::orderBy('id', 'asc')->paginate(15);//Get all roles
        return view('admin.auth.roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $permissions = Permission::all();//Get all permissions
        return view('admin.auth.roles.create', ['permissions'=>$permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
            'name'=>'required|unique:roles|max:30',
            'permissions' =>'required',
        ]);

        if ($validator->passes()) {
            $role = new Role();
            $role->name = $request->name;
            $role->save();
            foreach ($request->permissions as $permission) {                            //Looping through selected permissions
                $p = Permission::where('id', '=', $permission)->firstOrFail(); 
                $role = Role::where('name', '=', $request->name)->first();                       //Fetch the newly created role and assign permission
                $role->givePermissionTo($p);
            }
            Session::flash('success', 'The data was successfully inserted.');
            return redirect()->route('admin.auth.roles.index');
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
    public function show($id) {
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.auth.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $role = Role::findOrFail($id);//Get role with the given id
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:30|unique:roles,name,'.$id,
            'permissions' =>'required',
        ]);

        if ($validator->passes()) {
            $role = Role::find($id);
            $role->name = $request->name;
            $role->save();

            $p_all = Permission::all();//Get all permissions
            foreach ($p_all as $p) {
                $role->revokePermissionTo($p); //Remove all permissions associated with role
            }
            foreach ($request->permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
                $role->givePermissionTo($p);  //Assign permission to role
            }

            Session::flash('success', 'The data was successfully updated.');
            return redirect()->route('admin.auth.roles.index');
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
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $p_all = Permission::all();//Get all permissions
        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }
        $role->delete();

        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->route('admin.auth.roles.index');

    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $p_all = Permission::all();//Get all permissions
        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }
        $role->delete();

        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->route('admin.auth.roles.index');

    }
}