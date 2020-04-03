<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            [
            	'name' => 'Active',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
	        [
            	'name' => 'Inactive',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ]
	    ]);
    }
}
