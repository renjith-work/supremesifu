<?php

use Illuminate\Database\Seeder;

class ProductAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_attributes')->insert([
        	[
        		'code'          =>  'shirt-collar',
        		'name'          =>  'Collar',
	            'frontend_type'   =>  'select',
	            'product_attribute_set_id'     =>  1,
	            'is_filterable'          =>  1,
	            'is_required'          =>  1
        	],[
        		'code'          =>  'shirt-collar-optionals',
        		'name'          =>  'Collar Optionals',
	            'frontend_type'   =>  'select',
	            'product_attribute_set_id'     =>  1,
	            'is_filterable'          =>  1,
	            'is_required'          =>  1
        	],[
        		'code'          =>  'shirt-cuff',
        		'name'          =>  'Cuff',
	            'frontend_type'   =>  'select',
	            'product_attribute_set_id'     =>  1,
	            'is_filterable'          =>  1,
	            'is_required'          =>  1
        	],[
        		'code'          =>  'shirt-pocket',
        		'name'          =>  'Pocket',
	            'frontend_type'   =>  'select',
	            'product_attribute_set_id'     =>  1,
	            'is_filterable'          =>  1,
	            'is_required'          =>  1
        	],
        ]);
    }
}
