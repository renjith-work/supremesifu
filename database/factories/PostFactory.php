<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
	
	$title = $faker->unique()->sentence($nbWords = 6, $variableNbWords = true);
	$slug = Str::slug($title);

    return [
        'category_id' => $faker->numberBetween($min = 2, $max = 5),
		'user_id' 	=> $faker->numberBetween($min = 1, $max = 5),
		'title' 	=> $title,
		'slug' 		=> $slug,
		'bodyH'		=> $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
		'image'     => 'post.jpg',
		'album'     =>  '["1.jpeg","2.jpg"]',
		'video'		=> 'https://www.youtube.com/embed/z7zB8GYQ0Sc',
		'metatag'   =>  $title,
		'metadescp' =>  $title,
    ];
});
