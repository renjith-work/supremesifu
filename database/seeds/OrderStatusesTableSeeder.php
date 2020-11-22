<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert([
            [
            	'name'      => 'Pending',
		        'description'   =>  'Pending',
		        'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
            ], 
            [
            	'name'      => 'Processing',
		        'description'   =>  'Processing',
		        'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
            ],
            [
                'name'      => 'Shipped',
                'description'   =>  'Shipped',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], 
            [
                'name'      => 'Transit',
                'description'   =>  'Transit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], 
            
            [
            	'name'      => 'Delivered',
		        'description'   =>  'Delivered',
		        'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
            ], 
            [
            	'name'      => 'Declined',
		        'description'   =>  'Declined',
		        'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
            ] 
        ]);
    }
}
