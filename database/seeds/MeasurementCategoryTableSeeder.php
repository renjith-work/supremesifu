<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MeasurementCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('measurement_categories')->insert([
        	[
        		'name'       =>  'Regular Measurement',
        		'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	],
        	[
        		'name'       =>  'Direct Measurement',
        		'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	]
        ]);
    }
}
