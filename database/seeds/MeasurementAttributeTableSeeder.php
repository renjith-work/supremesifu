<?php

use Illuminate\Database\Seeder;

class MeasurementAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('measurement_attributes')->insert([
        	[
        		'code'          =>  'shirt_neck',
        		'name'          =>  'Neck Size',
        		'frontend_type'          =>  'select',
                'measurement_category_id'          =>  1,
                'product_attribute_set_id' => 1,
        		'tutorial_id'          =>  1,
        	],
        	[
        		'code'          =>  'shirt_shoulder',
        		'name'          =>  'Shoulder Size',
        		'frontend_type'          =>  'select',
        		'measurement_category_id'          =>  1,
                'product_attribute_set_id' => 1,
        		'tutorial_id'          =>  1,
        	],
        	[
        		'code'          =>  'shirt_front',
        		'name'          =>  'Front Length',
        		'frontend_type'          =>  'select',
        		'measurement_category_id'          =>  1,
                'product_attribute_set_id' => 1,
        		'tutorial_id'          =>  1,
        	],
        	[
        		'code'          =>  'shirt_back',
        		'name'          =>  'Back Length',
        		'frontend_type'          =>  'select',
        		'measurement_category_id'          =>  1,
                'product_attribute_set_id' => 1,
        		'tutorial_id'          =>  1,
        	],
        	[
        		'code'          =>  'shirt_sleeve',
        		'name'          =>  'Sleeve Length',
        		'frontend_type'          =>  'select',
        		'measurement_category_id'          =>  1,
                'product_attribute_set_id' => 1,
        		'tutorial_id'          =>  1,
        	],
        	[
        		'code'          =>  'shirt_chest',
        		'name'          =>  'Chest Size',
        		'frontend_type'          =>  'select',
        		'measurement_category_id'          =>  1,
                'product_attribute_set_id' => 1,
        		'tutorial_id'          =>  1,
        	],
        	[
        		'code'          =>  'shirt_waist',
        		'name'          =>  'Waist Size',
        		'frontend_type'          =>  'select',
        		'measurement_category_id'          =>  1,
                'product_attribute_set_id' => 1,
        		'tutorial_id'          =>  1,
        	],
        	[
        		'code'          =>  'shirt_hip',
        		'name'          =>  'Hip Size',
        		'frontend_type'          =>  'select',
        		'measurement_category_id'          =>  1,
                'product_attribute_set_id' => 1,
        		'tutorial_id'          =>  1,
        	],
        	[
        		'code'          =>  'shirt_elbow',
        		'name'          =>  'Elbow Size',
        		'frontend_type'          =>  'select',
        		'measurement_category_id'          =>  1,
                'product_attribute_set_id' => 1,
        		'tutorial_id'          =>  1,
        	],
        	[
        		'code'          =>  'shirt_armhole',
        		'name'          =>  'Armhole Size',
        		'frontend_type'          =>  'select',
        		'measurement_category_id'          =>  1,
                'product_attribute_set_id' => 1,
        		'tutorial_id'          =>  1,
        	],
        	[
        		'code'          =>  'shirt_cuff',
        		'name'          =>  'Cuff Size',
        		'frontend_type'          =>  'select',
        		'measurement_category_id'          =>  1,
                'product_attribute_set_id' => 1,
        		'tutorial_id'          =>  1,
        	],
            [
                'code'          =>  'shirt_chest_size',
                'name'          =>  'Chest Size',
                'frontend_type'          =>  'select',
                'measurement_category_id'          =>  2,
                'product_attribute_set_id' => 1,
                'tutorial_id'          =>  1,
            ],
            [
                'code'          =>  'shirt_waist_size',
                'name'          =>  'Waist Size',
                'frontend_type'          =>  'select',
                'measurement_category_id'          =>  2,
                'product_attribute_set_id' => 1,
                'tutorial_id'          =>  1,
            ],
            [
                'code'          =>  'shirt_hip_size',
                'name'          =>  'Hip Size',
                'frontend_type'          =>  'select',
                'measurement_category_id'          =>  2,
                'product_attribute_set_id' => 1,
                'tutorial_id'          =>  1,
            ],

        ]);
    }
}
