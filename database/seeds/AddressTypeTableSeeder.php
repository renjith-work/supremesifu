<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AddressTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('address_types')->insert([
            [
            	'name' => 'Default Billing Address',
            	'code' => 'default_billing_address',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
            ],
            [
            	'name' => 'Default Shipping Address',
            	'code' => 'default_shipping_address',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
            ],
            [
            	'name' => 'Other Address',
            	'code' => 'other_address',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
