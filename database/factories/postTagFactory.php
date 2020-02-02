<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post\PostTag;
use Faker\Generator as Faker;

$factory->define(PostTag::class, function (Faker $faker) {
    
    $name = $faker->unique()->city;
	$slug = Str::slug($name);

    return [
        'name'      => $name,
        'slug'      => $slug
    ];
});
