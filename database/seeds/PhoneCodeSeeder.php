<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PhoneCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phone_codes')->insert([
            [
                'value' => '+60',
                'code' => 'MY +60',
                'country_id' => 134,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
