<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FabricAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fabric_attributes')->insert([
        	[
        		'code'          =>  'design',
	            'name'          =>  'Design',
	            'frontend_type' =>  'select',
	            'is_filterable' =>  1,
	            'is_required'   =>  1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	],
            [
            	'code'          =>  'material',
	            'name'          =>  'Material',
	            'frontend_type' =>  'select',
	            'is_filterable' =>  1,
	            'is_required'   =>  1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
	        [
            	'code'          =>  'season',
	            'name'          =>  'Season',
	            'frontend_type' =>  'select',
	            'is_filterable' =>  1,
	            'is_required'   =>  1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ]
	    ]);
    }
}
