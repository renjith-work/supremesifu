<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Session;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
        $permissions = Permission::orderBy('id', 'asc')->paginate(20); //Get all permissions
        return view('admin.auth.permissions.index')->with('permissions', $permissions);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {
        $roles = Role::get(); //Get all roles
        return view('admin.auth.permissions.create')->with('roles', $roles);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
            'name'=>'required|max:40',
        ]);

        if ($validator->passes()) {
            $permission = new Permission;
            $permission->name = $request->name;
            $permission->save();
            Session::flash('success', 'The data was successfully updated.');
            return redirect()->route('admin.auth.permissions.create');
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
        return redirect('admin.auth.permissions');
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id) {
        $permission = Permission::findOrFail($id);
        $roles = Role::all();
        return view('admin.auth.permissions.edit', compact('permission'))->with('roles', $roles);;
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
            'name'=>'required|max:40',
        ]);

        if ($validator->passes()) {
            $permission = Permission::find($id);
            $permission->name = $request->name;
            $permission->save();
            Session::flash('success', 'The data was successfully updated.');
            return redirect()->route('admin.auth.permissions.index');
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
        
        $permission = Permission::findOrFail($id);

        //Make it impossible to delete this specific permission    
        if ($permission->name == "Administer roles & permissions") 
        {
            Session::flash('success', 'This permission cannot be deleted.');
            return redirect()->route('admin.auth.permissions.index');
        }else{
            $permission->delete();
            Session::flash('success', 'The data was successfully deleted.');
            return redirect()->route('admin.auth.permissions.index');
        }

    }

    public function delete($id) {
        $permission = Permission::findOrFail($id);

        //Make it impossible to delete this specific permission    
        if ($permission->name == "Administer roles & permissions") 
        {
            Session::flash('success', 'This permission cannot be deleted.');
            return redirect()->route('admin.auth.permissions.index');
        }else{
            $permission->delete();
            Session::flash('success', 'The data was successfully deleted.');
            return redirect()->route('admin.auth.permissions.index');
        }
    }
}
