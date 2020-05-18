<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaxZoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tax_zones')->insert([
            [
                'name'      =>  'Kuala Lumpur',
                'code' =>  'KL',
                'tax_country_id' =>  '1',
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Selangor',
                'code' =>  'SG',
                'tax_country_id' =>  '1',
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Johor Bahru',
                'code' =>  'JB',
                'tax_country_id' =>  '1',
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
