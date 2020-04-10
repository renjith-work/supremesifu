<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FabricCLassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fabric_classes')->insert([
            [
            	'name' => 'Silver Class',
            	'slug' => 'silver-class',
            	'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
            	'price' => 'MYR 18 - MYR 23',
            	'metatag' => 'tag1, tag2, tag3',
            	'metadescp' => 'Meta Description',
            	'image' => 'silver.jpg',
            	'status_id' => '1',
                'grade' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],[
            	'name' => 'Gold Class',
            	'slug' => 'gold-class',
            	'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
            	'price' => 'MYR 23 - MYR 28',
            	'metatag' => 'tag1, tag2, tag3',
            	'metadescp' => 'Meta Description',
            	'image' => 'gold.jpg',
            	'status_id' => '1',
                'grade' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],[
            	'name' => 'Platinum Class',
            	'slug' => 'platinum-class',
            	'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
            	'price' => 'MYR 28 - MYR 35',
            	'metatag' => 'tag1, tag2, tag3',
            	'metadescp' => 'Meta Description',
            	'image' => 'platinum.jpg',
            	'status_id' => '1',
                'grade' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],[
            	'name' => 'Diamond Class',
            	'slug' => 'diamond-class',
            	'description' => 'Lorem ipsum dolor sit amet, vitae fermentum wisi commodo sodales enim ac, nibh turpis, pede curabitur lectus feugiat ac, euismod montes mi, elit sodales turpis felis non. Pretium orci eget consectetuer in, donec et quam. Aute metus, amet sit, eros hac eros at, nunc cras. Quisque erat, dictum pede, et dui vivamus quis. Sem eu dui dolor proin a.',
            	'price' => 'MYR 35 - MYR 45',
            	'metatag' => 'tag1, tag2, tag3',
            	'metadescp' => 'Meta Description',
            	'image' => 'diamond.jpg',
            	'status_id' => '1',
                'grade' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
       ]);
    }
}
