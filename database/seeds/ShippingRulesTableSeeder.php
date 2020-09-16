<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShippingRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_rules')->insert([
            [
                'zone_id' => 1,
                'min_weight' => 0.00,
                'max_weight' => 1.00,
                'price' => 10.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'zone_id' => 1,
                'min_weight' => 1.00,
                'max_weight' => 2.00,
                'price' => 15.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'zone_id' => 1,
                'min_weight' => 2.00,
                'max_weight' => 3.00,
                'price' => 20.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'zone_id' => 1,
                'min_weight' => 3.00,
                'max_weight' => 4.00,
                'price' => 25.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'zone_id' => 1,
                'min_weight' => 4.00,
                'max_weight' => 20.00,
                'price' => 30.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
