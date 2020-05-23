<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InventoryUnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventory_units')->insert([
        	[
        		'name'          =>  'Gram',
                'abbrevation'   =>  'gm',
                'description'   =>  'Gram',
                'type_id'       =>  2,
                'status'        =>  1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          =>  'Meter',
                'abbrevation'   =>  'm',
                'description'   =>  'Meter',
                'type_id'       =>  1,
                'status'        =>  1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          =>  'Litre',
                'abbrevation'   =>  'ltr',
                'description'   =>  'Litre',
                'type_id'       =>  3,
                'status'        =>  1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}
