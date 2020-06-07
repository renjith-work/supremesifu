<?php

use Illuminate\Database\Seeder;

class RolesHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_has_permissions')->insert([
            'permission_id'      =>  1,
            'role_id'      =>  1,
        ]);

        DB::table('model_has_roles')->insert([
            'role_id'      =>  1,
            'model_type'      =>  'App\User',
            'model_id'      =>  1,
        ]);

    }
}
