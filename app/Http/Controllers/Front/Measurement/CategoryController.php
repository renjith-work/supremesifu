<?php

namespace App\Http\Controllers\Front\Measurement;

use App\Models\Measurement\MeasurementCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function list(){
    	$data = MeasurementCategory::orderBy('id', 'asc')->get();
        return response()->json($data);
    }
}
