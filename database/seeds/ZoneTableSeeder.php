<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ZoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zones')->insert([
            [
                'name'      =>  'Kuala Lumpur',
                'code' =>  'KUL',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Selangor Darul Ehsan',
                'code' =>  'SGR',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], 
            [
                'name'      =>  'Putrajaya',
                'code' =>  'PJY',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  "Johor Darul Ta'zim",
                'code' =>  'JHR',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Kedah Darul Aman',
                'code' =>  'KDH',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Kelantan Darul Naim',
                'code' =>  'KTN',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Malacca',
                'code' =>  'MLK',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Negeri Sembilan Darul Khusus',
                'code' =>  'NSN',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Pahang Darul Makmur',
                'code' =>  'PHG',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Penang	',
                'code' =>  'PNG',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Perak Darul Ridzuan',
                'code' =>  'PRK',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Perlis Indera Kayangan',
                'code' =>  'PLS',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Sabah',
                'code' =>  'SBH',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Sarawak',
                'code' =>  'SWK',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Terengganu Darul Iman',
                'code' =>  'TRG',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      =>  'Labuan',
                'code' =>  'LBN',
                'country_id' =>  134,
                'status'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
