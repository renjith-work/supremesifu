<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FabricTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	
        DB::table('fabrics')->insert([
            [
            	'name'      	=> 'Silver Class -1',
            	'slug'      	=> 'silver-class-1',
            	'description'	=> 'Test Description',
            	'price'			=> 10.00,
            	'image'			=> 'class.jpg',
            	'fabric_class_id'	=> 1,
            	'brand_id'	=> 1,
            	'status'	=> 1,
	        ],[
            	'name'      	=> 'Silver Class -2',
            	'slug'      	=> 'silver-class-2',
            	'description'	=> 'Test Description',
            	'price'			=> 10.00,
            	'image'			=> 'class.jpg',
            	'fabric_class_id'	=> 1,
            	'brand_id'	=> 1,
            	'status'	=> 1,
	        ],[
            	'name'      	=> 'Silver Class -3',
            	'slug'      	=> 'silver-class-3',
            	'description'	=> 'Test Description',
            	'price'			=> 10.00,
            	'image'			=> 'class.jpg',
            	'fabric_class_id'	=> 1,
            	'brand_id'	=> 1,
            	'status'	=> 1,
	        ]
        ]);
    }
}
