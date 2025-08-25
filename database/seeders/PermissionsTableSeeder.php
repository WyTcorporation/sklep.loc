<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'alias' => 'SUPER_ADMIN',
                'title' => 'Super Admin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'alias' => 'ROLES_ACCESS',
                'title' => 'Roles Access',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'alias' => 'USER_ACCESS',
                'title' => 'User Access',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'alias' => 'DASHBOARD_ACCESS',
                'title' => 'Dashboard access',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
