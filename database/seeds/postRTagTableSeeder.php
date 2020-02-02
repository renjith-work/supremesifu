<?php

use Illuminate\Database\Seeder;

class postRTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	for($i=0; $i < 31; $i++ ){
    		for($j=0; $j < 6; $j++ ){
    			DB::table('post_tag')->insert([
	            	'post_id'      	=> $i,
	            	'tag_id' 	=> rand(1, 30),
	    		]);
    		}
    	}
    }
}
