<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductDesignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_designs')->insert([
            
            [
            	'product_category_id' => 3,
	            'fabric_id' => 1,
	            'name' => 'Shirt Design 1',
	            'slug' => 'shirt-design-1',
	            'price' => 60.00,
	            'og_price' => 110.00,
	            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
	            'summary' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
	            'p_image' => '1.jpg',
	            's_image' => '2.jpg',
	            'album' => '{"0":"1.jpg","1":"2.jpg","2":"3.jpg","3":"4.jpg","4":"5.jpg"}',
	            'folder' => 'shirt-1',
	            'status_id' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	],
        	[
            	'product_category_id' => 3,
	            'fabric_id' => 1,
	            'name' => 'Shirt Design 2',
	            'slug' => 'shirt-design-2',
	            'price' => 60.00,
	            'og_price' => 110.00,
	            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
	            'summary' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
	            'p_image' => '1.jpg',
	            's_image' => '2.jpg',
	            'album' => '{"0":"1.jpg","1":"2.jpg","2":"3.jpg","3":"4.jpg","4":"5.jpg"}',
	            'folder' => 'shirt-2',
	            'state' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	],
        	[
            	'product_category_id' => 3,
	            'fabric_id' => 1,
	            'name' => 'Shirt Design 3',
	            'slug' => 'shirt-design-3',
	            'price' => 60.00,
	            'og_price' => 110.00,
	            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
	            'summary' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
	            'p_image' => '1.jpg',
	            's_image' => '2.jpg',
	            'album' => '{"0":"1.jpg","1":"2.jpg","2":"3.jpg","3":"4.jpg","4":"5.jpg"}',
	            'folder' => 'shirt-3',
	            'state' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	],
        	[
            	'product_category_id' => 3,
	            'fabric_id' => 1,
	            'name' => 'Shirt Design 4',
	            'slug' => 'shirt-design-4',
	            'price' => 60.00,
	            'og_price' => 110.00,
	            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
	            'summary' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
	            'p_image' => '1.jpg',
	            's_image' => '2.jpg',
	            'album' => '{"0":"1.jpg","1":"2.jpg","2":"3.jpg","3":"4.jpg","4":"5.jpg"}',
	            'folder' => 'shirt-4',
	            'state' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	],
        	[
            	'product_category_id' => 3,
	            'fabric_id' => 1,
	            'name' => 'Shirt Design 5',
	            'slug' => 'shirt-design-5',
	            'price' => 60.00,
	            'og_price' => 110.00,
	            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
	            'summary' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
	            'p_image' => '1.jpg',
	            's_image' => '2.jpg',
	            'album' => '{"0":"1.jpg","1":"2.jpg","2":"3.jpg","3":"4.jpg","4":"5.jpg"}',
	            'folder' => 'shirt-5',
	            'state' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	],
        	[
            	'product_category_id' => 3,
	            'fabric_id' => 1,
	            'name' => 'Shirt Design 6',
	            'slug' => 'shirt-design-6',
	            'price' => 60.00,
	            'og_price' => 110.00,
	            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
	            'summary' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
	            'p_image' => '1.jpg',
	            's_image' => '2.jpg',
	            'album' => '{"0":"1.jpg","1":"2.jpg","2":"3.jpg","3":"4.jpg","4":"5.jpg"}',
	            'folder' => 'shirt-6',
	            'state' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
        	],
        ]);
    }
}
