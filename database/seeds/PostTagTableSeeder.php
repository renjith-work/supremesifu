<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factory;
use App\Models\Post\PostTag;
use Faker\Generator as Faker;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Post\PostTag::class, 30)->create();
    }
}
