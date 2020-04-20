<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CustomProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('custom_product_categories')->insert([
            [
                'name' => 'Shirt',
                'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pants',
                'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
