<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MeasurementProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('measurement_profiles')->insert([
            [   
                'product_attribute_set_id' => 1,
                'name'       =>  'S - Small (Size 32)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   
                'product_attribute_set_id' => 1,
                'name'       =>  'M - Medium (Size 34)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   
                'product_attribute_set_id' => 1,
                'name'       =>  'L - Large (Size 36)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   
                'product_attribute_set_id' => 1,
                'name'       =>  'XL - Extra Large (Size 38)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   
                'product_attribute_set_id' => 1,
                'name'       =>  'XXL - Extra Extra Large (Size 40)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
            
        ]);
    }
}
