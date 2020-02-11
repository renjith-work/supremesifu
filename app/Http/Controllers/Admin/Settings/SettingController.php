<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Setting;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
Use Image;
Use Storage;

class SettingController extends Controller
{
    public function index()
    {
    	return view('admin.settings.index');
    }

    public function update(Request $request)
    {
    	if ($request-> hasFile('site_logo')) //Check if the file exists
        {
            $image = $request->file('site_logo'); //Grab and store the file on to $image
            $filename = 'site_logo-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
            $location = public_path('images/settings/'. $filename);
            Image::make($image)->resize(311, 87)->save($location); //Use intervention to create an image model and store the file with the resize.
            
            $oldFilename = Setting::get('site_logo');
            Setting::set('site_logo', $filename);
            Storage::delete('settings/'. $oldFilename);
        } 
        elseif ($request-> hasFile('site_favicon')) //Check if the file exists
        {
            $image = $request->file('site_favicon'); //Grab and store the file on to $image
            $filename = 'site_favicon-'.time(). '.'. $image->getClientOriginalExtension(); //Create a new filename
            $location = public_path('images/settings/'. $filename);
            Image::make($image)->resize(311, 87)->save($location); //Use intervention to create an image model and store the file with the resize.
            
            $oldFilename = Setting::get('site_favicon');
            Setting::set('site_favicon', $filename);
            Storage::delete('settings/'. $oldFilename);
        } else {

            $keys = $request->except('_token');

            foreach ($keys as $key => $value)
            {
                Setting::set($key, $value);
            }
        }
        Session::flash('success', 'The data was successfully updated.');
        return redirect()->back();
    }
}
