<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserMeasurementProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_measurement_profiles')->insert([
        	[	
        		'user_id'	=> 1,
        		'product_category_id' => 3,
        		'name'       =>  'S - Small (Size 32)',
        		'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	],
        	[	
        		'user_id'	=> 1,
        		'product_category_id' => 3,
        		'name'       =>  'M - Medium (Size 34)',
        		'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	],
        	[	
        		'user_id'	=> 1,
        		'product_category_id' => 3,
        		'name'       =>  'L - Large (Size 36)',
        		'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	],
        	[	
        		'user_id'	=> 1,
        		'product_category_id' => 3,
        		'name'       =>  'XL - Extra Large (Size 38)',
        		'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	],
        	[	
        		'user_id'	=> 1,
        		'product_category_id' => 3,
        		'name'       =>  'XXL - Extra Extra Large (Size 40)',
        		'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	]
        	
        ]);
    }
}
