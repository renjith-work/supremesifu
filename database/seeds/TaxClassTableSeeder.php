<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaxClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tax_classes')->insert([
            [
                'name'      =>  'Test',
                'description'      =>  'Test 123',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
