<?php

use Illuminate\Database\Seeder;

class ProductAttributeValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_attribute_values')->insert([
        	[
        		'product_attribute_id'          =>  '1',
        		'value'          =>  'Updated Straight Point Collar',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'collar.png',
	            'd_drawing'          =>  'collar.png',
	            'c_image'          =>  'collar.png',
        	],
        	[
        		'product_attribute_id'          =>  '1',
        		'value'          =>  'Cutaway Collar',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'collar.png',
	            'd_drawing'          =>  'collar.png',
	            'c_image'          =>  'collar.png',
        	],
        	[
        		'product_attribute_id'          =>  '1',
        		'value'          =>  'Club Collar',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'collar.png',
	            'd_drawing'          =>  'collar.png',
	            'c_image'          =>  'collar.png',
        	],
        	[
        		'product_attribute_id'          =>  '1',
        		'value'          =>  'Updated Spear with Short Points',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'collar.png',
	            'd_drawing'          =>  'collar.png',
	            'c_image'          =>  'collar.png',
        	],
        	[
        		'product_attribute_id'          =>  '1',
        		'value'          =>  'Low Straight Point Collar',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'collar.png',
	            'd_drawing'          =>  'collar.png',
	            'c_image'          =>  'collar.png',
        	],
        	[
        		'product_attribute_id'          =>  '1',
        		'value'          =>  'Semi Spread Collar',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'collar.png',
	            'd_drawing'          =>  'collar.png',
	            'c_image'          =>  'collar.png',
        	],
        	[
        		'product_attribute_id'          =>  '1',
        		'value'          =>  'Narrow Straight Point Collar',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'collar.png',
	            'd_drawing'          =>  'collar.png',
	            'c_image'          =>  'collar.png',
        	],
        	[
        		'product_attribute_id'          =>  '1',
        		'value'          =>  'Button Down Collar',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'collar.png',
	            'd_drawing'          =>  'collar.png',
	            'c_image'          =>  'collar.png',
        	],
        	[
        		'product_attribute_id'          =>  '2',
        		'value'          =>  'Normal',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'collarOptional.svg',
	            'd_drawing'          =>  'collarOptional.svg',
	            'c_image'          =>  'collarOptional.svg',
        	],
        	[
        		'product_attribute_id'          =>  '2',
        		'value'          =>  'Soft',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'collarOptional.svg',
	            'd_drawing'          =>  'collarOptional.svg',
	            'c_image'          =>  'collarOptional.svg',
        	],
        	[
        		'product_attribute_id'          =>  '2',
        		'value'          =>  'Stiff',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'collarOptional.svg',
	            'd_drawing'          =>  'collarOptional.svg',
	            'c_image'          =>  'collarOptional.svg',
        	],
        	[
        		'product_attribute_id'          =>  '3',
        		'value'          =>  'Angled',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'cuff.svg',
	            'd_drawing'          =>  'cuff.svg',
	            'c_image'          =>  'cuff.svg',
        	],
        	[
        		'product_attribute_id'          =>  '3',
        		'value'          =>  'Round',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'cuff.svg',
	            'd_drawing'          =>  'cuff.svg',
	            'c_image'          =>  'cuff.svg',
        	],
        	[
        		'product_attribute_id'          =>  '3',
        		'value'          =>  'Convertible',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'price'     =>  null,
	            'd_image'          =>  'cuff.svg',
	            'd_drawing'          =>  'cuff.svg',
	            'c_image'          =>  'cuff.svg',
        	],
        	[
        		'product_attribute_id'          =>  '4',
        		'value'          =>  'Without Pocket',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
	            'd_image'          =>  'pocket.png',
	            'd_drawing'          =>  'pocket.png',
	            'c_image'          =>  'pocket.png',
	            'price'     =>  null,
        	],
        	[
        		'product_attribute_id'          =>  '4',
        		'value'          =>  'One Pocket',
	            'description'   =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
	            'd_image'          =>  'pocket.png',
	            'd_drawing'          =>  'pocket.png',
	            'c_image'          =>  'pocket.png',
	            'price'     =>  null,
        	]
	    ]);
    }
}
