<?php

use Illuminate\Database\Seeder;
use App\Models\Post\PostStatus;
use Carbon\Carbon;

class PostStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_statuses')->insert([
            [
            	'name'      => 'Draft',
            	'description' => 'This is an incomplete post that’s not ready for publication',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
	        [
            	'name'      => 'Pending',
            	'description' => 'Awaiting a user with higher permissions to publish',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
	        [
            	'name'      => 'Private',
            	'description' => 'Viewable only to registered users',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
	        [
            	'name'      => 'Published',
            	'description' => 'Viewable by any site visitor',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
	        
	        [
            	'name'      => 'Trash',
            	'description' => 'These posts are waiting for deletion',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
       	]);
    }
}
