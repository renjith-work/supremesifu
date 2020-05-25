<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductImagePositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_image_positions')->insert([
            [
                'name'          => 'primary',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'secondary',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'album',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]); 
    }
}
