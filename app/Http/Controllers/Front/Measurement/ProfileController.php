<?php

namespace App\Http\Controllers\Front\Measurement;

use App\Models\Measurement\UserMeasurementProfile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ProfileController extends Controller
{
	// public function __construct() {
 //         $this->middleware('auth', ['except' =>['list']]);
 //    }

    public function list(){
    	$data = UserMeasurementProfile::orderBy('id', 'asc')->get();
        return response()->json($data);
    }

    public function commonList(){

    	$customData = UserMeasurementProfile::where('user_id', 1)->get();;
    	$data = array();
    	foreach ($customData as $profile) {
    		$data[] = array(
    					'id' => $profile->id,	
    					'name' => $profile->name,	
    		);
    	}

    	return response()->json($data);
    }

    public function userList(){
        $data = array();

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $userData =  UserMeasurementProfile::where('user_id', $user_id)->get();
            foreach ($userData as $uprofile) {
                if (isset($uprofile->name)){
                    $data[] = array(
                                'id' => $uprofile->id,  
                                'name' => $uprofile->name,  
                    );
                }
            }
        }
    	return response()->json($data);
    }

    public function allList(){
        $data = array();

        $customData = UserMeasurementProfile::where('user_id', 1)->get();
        $data = array();
        foreach ($customData as $profile) {
            $data1[] = array(
                        'id' => $profile->id,   
                        'name' => $profile->name,  
                        'user_id' => 1 
            );
        }

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $userData =  UserMeasurementProfile::where('user_id', $user_id)->get();
            foreach ($userData as $uprofile) {
                if (isset($uprofile->name)){
                    $data2[] = array(
                                'id' => $uprofile->id,  
                                'name' => $uprofile->name,
                                'user_id' => $user_id  
                    );
                }
            }
        }
         $data = array(
                $data1, $data2
         );
        return response()->json($data);
    }

    public function saveName(Request $request){
        $name = $request->name;
        $profile = UserMeasurementProfile::find($request->id);
        $profile->name = $name;
        $profile->save();
        return response()->json($profile);
    }

}
