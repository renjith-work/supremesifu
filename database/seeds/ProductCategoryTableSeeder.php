<?php

use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
        	[
        		'name'          =>  'Root',
        		'slug'          =>  'root',
	            'description'   =>  'This is the root category, don\'t delete this one',
	            'parent_id'     =>  null,
	            'menu'          =>  0,
        	],
        	[
        		'name'          =>  'Clothing',
        		'slug'          =>  'clothing',
	            'description'   =>  'This is the clothing category.',
	            'parent_id'     =>  1,
	            'menu'          =>  0,
        	],
        	[
        		'name'          =>  'Shirt',
        		'slug'          =>  'shirt',
	            'description'   =>  'This is the shirt category.',
	            'parent_id'		=> 	2,
	            'menu'          =>  0,
        	],
	    ]);
    }
}
