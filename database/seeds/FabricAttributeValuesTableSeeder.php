<?php

use Illuminate\Database\Seeder;

class FabricAttributeValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designs = ['solid', 'stripes', 'Small Checks', 'Big Checks', 'Hairline Stripes'];
        $materials = ['100% Pure Cotton', '100% Non-Iron Cotton', '100% Wrinkle Free Cotton', '100% Wrinkle Free Linen', 'Linen', 'Cotton Linen'];
        $seasons = ['Summer', 'Winter', 'Spring', 'All Year Around'];

        foreach ($designs as $design)
        {
        	DB::table('fabric_attribute_values')->insert([
	        	[
	        		'fabric_attribute_id'      =>  1,
                	'value'             =>  $design,
                	'price'             =>  null,
	        	]
	        ]);
        }

        foreach ($materials as $material)
        {
        	DB::table('fabric_attribute_values')->insert([
	        	[
	        		'fabric_attribute_id'      =>  2,
                	'value'             =>  $material,
                	'price'             =>  null,
	        	]
	        ]);
        }

        foreach ($seasons as $season)
        {
        	DB::table('fabric_attribute_values')->insert([
	        	[
	        		'fabric_attribute_id'      =>  3,
                	'value'             =>  $season,
                	'price'             =>  null,
	        	]
	        ]);
        }
    }
}
