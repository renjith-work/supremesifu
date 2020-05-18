<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaxCountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tax_countries')->insert([
            [
                'name'      =>  'Malaysia',
                'iso_code2' =>  'MY',
                'iso_code3' =>  'MYS',
                'numeric'   => '458',
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Singapore',
                'iso_code2' =>  'SG',
                'iso_code3' =>  'SGP',
                'numeric'   => '702',
                'status'    => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
