<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaxRateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tax_rates')->insert([
            [
                'tax_class_id'      =>  1,
                'tax_zone_id'      =>  1,
                'rate' =>  6,
                'description' =>  'Regular Malaysia Tax',
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'tax_class_id'      =>  1,
                'tax_zone_id'      =>  2,
                'rate' =>  6,
                'description' =>  'Regular Malaysia Tax',
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'tax_class_id'      =>  1,
                'tax_zone_id'      =>  3,
                'rate' =>  6,
                'description' =>  'Regular Malaysia Tax',
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
            
        ]);
    }
}
