<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FabricBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fabric_brands')->insert([
            [
            	'name' => 'Albini',
            	'slug' => 'albini',
            	'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
            	'image' => 'brand.jpg',
            	'status_id' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],[
            	'name' => 'Thomas Mason',
            	'slug' => 'thomas-mason',
            	'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
            	'image' => 'brand.jpg',
            	'status_id' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],[
            	'name' => 'Cancilini',
            	'slug' => 'cancilini',
            	'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
            	'image' => 'brand.jpg',
            	'status_id' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],[
            	'name' => 'Soktas',
            	'slug' => 'soktas',
            	'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
            	'image' => 'brand.jpg',
            	'status_id' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],[
            	'name' => 'D & J Anderson',
            	'slug' => 'djanderson',
            	'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
            	'image' => 'brand.jpg',
            	'status_id' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],[
            	'name' => 'Valli',
            	'slug' => 'valli',
            	'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
            	'image' => 'brand.jpg',
            	'status_id' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],[
            	'name' => 'Monti',
            	'slug' => 'monti',
            	'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
            	'image' => 'brand.jpg',
            	'status_id' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
        ]);
    }
}
