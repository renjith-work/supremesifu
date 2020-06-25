<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MonogramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('monograms')->insert([
            [
            	'product_attribute_set_id' => 1,
            	'name' => 'Chest Pocket Monogram',
                'code' => 'chest_pocket_monogram',
            	'letter' =>  6,
            	'tutorial_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
	        [
            	'product_attribute_set_id' => 1,
            	'name' => 'Waist Monogram',
                'code' => 'waist_monogram',
            	'letter' =>  8,
            	'tutorial_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
       ]);
    }
}
