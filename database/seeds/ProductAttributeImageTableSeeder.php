<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductAttributeImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_attribute_images')->insert([
            [
                'name' => 'Primary Image',
                'code' => 'primary_image',
                'height' => 200,
                'width' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Secondary Image',
                'code' => 'secondary_image',
                'height' => 200,
                'width' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Primary Drawing',
                'code' => 'primary_drawing',
                'height' => 200,
                'width' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
