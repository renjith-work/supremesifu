<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post\PostCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(PostCategory::class, function (Faker $faker) {
    $name = $faker->name;
	$slug = Str::slug($name);

    return [
        'name'      => $name,
        'slug'      => $slug,
        'description'   =>  $faker->realText(100),
        'parent_id' => 1,
        'metatag' => $faker->realText(100),
        'metadescp' => $faker->realText(100),
    ];
});

