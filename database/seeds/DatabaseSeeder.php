<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	UsersTableSeeder::class,
        	PostTableSeeder::class,
        	PostCategoryTableSeeder::class,
        	PostStatusTableSeeder::class,
        	PostTagTableSeeder::class,
            PostDesignTableSeeder::class,
            // Roles and Permissions Seeder
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
        ]);
    }
}
