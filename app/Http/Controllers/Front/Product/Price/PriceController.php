<?php

namespace App\Http\Controllers\Front\Product\Price;

use App\Models\Product\Fabric\Fabric;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PriceController extends Controller
{
    public function calculate(Request $request){
    	$fab_id = $request->fab_id;
    	$product_id = $request->product_id;
    	$product_material = 1.5;
    	
    	$fabric = Fabric::find($fab_id);
    	$class = $fabric->class;
    	
    	$og_price = ($product_material * $fabric->price)+ $class->workmanship+$class->packaging+$class->profit; 

		switch ($class->name) {
		    case "Silver Class":
		        $price = 60.00;
		        break;
		    case "Gold Class":
		        $price = 70.00;
		        break;
		    case "Platinum Class":
		        $price = 80.00;
		        break;
		    case "Diamond Class":
		        $price = 90.00;
		        break;
		    default:
		        $price = $og_price;
		}

		$r_price = number_format((float)$price, 2, '.', '');
		$rog_price = number_format((float)$og_price, 2, '.', '');

		$data = array(
				'price' => $r_price,
				'og_price' => $rog_price
		);
    	return response()->json($data);

    }	
}
