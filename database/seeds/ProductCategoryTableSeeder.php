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
                'featured'     =>  1,
                'menu'     =>  1,
                'is_filterable'     =>  1,
                'image'     =>  'category.jpg',
                'metatag'     =>  'tag1, tag2, tag3',
                'metadescp'     =>  'tag1 tag2 tag3',
        	],
        	[
        		'name'          =>  'Clothing',
        		'slug'          =>  'clothing',
	            'description'   =>  'This is the clothing category.',
	            'parent_id'     =>  null,
                'featured'     =>  1,
                'menu'     =>  1,
                'is_filterable'     =>  1,
                'image'     =>  'category.jpg',
                'metatag'     =>  'tag1, tag2, tag3',
                'metadescp'     =>  'tag1 tag2 tag3',
        	],
        	[
        		'name'          =>  'Shirt',
        		'slug'          =>  'shirt',
	            'description'   =>  'This is the shirt category.',
	            'parent_id'     =>  null,
                'featured'     =>  1,
                'menu'     =>  1,
                'is_filterable'     =>  1,
                'image'     =>  'category.jpg',
                'metatag'     =>  'tag1, tag2, tag3',
                'metadescp'     =>  'tag1 tag2 tag3',
        	],
	    ]);
    }
}
