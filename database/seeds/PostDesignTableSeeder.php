<?php

use Illuminate\Database\Seeder;
use App\Models\Post\PostDesign;
use Carbon\Carbon;

class PostDesignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_designs')->insert([
            [
            	'name'      	=> 'Design 1 (Default) - Cover image, text and album',
            	'description' 	=> 'This will display the cover image at the top, text next and at the bottom the album, if any.',
	            'file'			=> 'design1.blade.php',
	            'created_at' 	=> Carbon::now(),
	            'updated_at' 	=> Carbon::now(),
	        ],
	        [
            	'name'      => 'Design 2 - Cover image, album slider and text',
            	'description' => 'This will display the cover image and the album as a slider at the top then the text.',
	            'file'			=> 'design2.blade.php',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
	        [
            	'name'      => 'Design 3 - Video, text and album',
            	'description' => 'This will display the video at the top, text next and at the bottom the album asw ell as the cover image.',
	            'file'			=> 'design3.blade.php',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
	        [
            	'name'      => 'Design 4 - Album slider, video and text',
            	'description' => 'This will display the cover image and the album as a slider, video along with the content and then the text.',
	            'file'			=> 'design4.blade.php',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
	        [
            	'name'      => 'Design 5 - Cover image, video, text and album',
            	'description' => 'This will display the cover image at the top, video along with the content then at bottom the album.',
	            'file'			=> 'design5.blade.php',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ],
	    ]);
    }
}
