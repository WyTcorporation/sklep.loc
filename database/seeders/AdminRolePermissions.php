<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRolePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array (
            0 =>  array (
                'id' => 1,
                'alias' => 'SUPER_ADMINISTRATOR',
                'title' => 'Super Administrator',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>  array (
                'id' => 2,
                'alias' => 'ADMINISTRATOR',
                'title' => 'Administrator',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>  array (
                'id' => 3,
                'alias' => 'MANAGER',
                'title' => 'Manager',
                'created_at' => NULL,
                'updated_at' => NULL,
            )
        ));

        \DB::table('role_user')->delete();

        \DB::table('role_user')->insert(array (
            0 =>  array (
                'id' => 1,
                'user_id' => 1,
                'role_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            )
        ));

        \DB::table('permission_menus')->delete();

        \DB::table('permission_menus')->insert(array (
            0 =>  array (
                'permission_id' => 1,
                'menu_id' => 1
            ),
            1 =>  array (
                'permission_id' => 1,
                'menu_id' => 2
            ),
            2 =>  array (
                'permission_id' => 1,
                'menu_id' => 3
            ),
            3 =>  array (
                'permission_id' => 1,
                'menu_id' => 4
            ),
            4 =>  array (
                'permission_id' => 1,
                'menu_id' => 5
            )
        ));

        \DB::table('permission_role')->delete();

        \DB::table('permission_role')->insert(array (
            0 =>  array (
                'id' => 1,
                'role_id' => 1,
                'permission_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL
            ),
            1 =>  array (
                'id' => 2,
                'role_id' => 2,
                'permission_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL
            )
        ));
    }
}
