<?php

namespace App\Http\Controllers\Front\Api\Measurement;

use App\Models\Measurement\UserMeasurementProfile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeasurementProfileController extends Controller
{
    public function loadAttributeValues(Request $request)
    {
        $profile = UserMeasurementProfile::find($request->id);

        $data = array();
        foreach ($profile->values as $value) {
            $data[] = array(
                'id' => $value->id,
                'profile' => $value->profile->name,
                'attribute_name' => $value->measurementAttribute->name,
                'attribute_code' => $value->measurementAttribute->code,
                'value' => $value->value,
            );
        }
        return response()->json($data);
    }

    public function attributeValues()
    {
        $profile = UserMeasurementProfile::find(1);
        // return response()->json($profile->values);

        $data = array();
        foreach($profile->values as $value)
        {
            $data[] = array(
                    'id' => $value->id,
                    'profile' => $value->profile->name,
                    'attribute_name' => $value->measurementAttribute->name,
                    'attribute_code' => $value->measurementAttribute->code,
                    'value' => $value->value,
            );
        }

        return response()->json($data);

    }
}
