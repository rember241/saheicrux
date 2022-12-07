<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        if (DB::table('users')->count() == 0) {
            $password = Hash::make('password');
            $users = DB::table('users')->insert([
                'name' => 'Super Admin',
                'email' => 'admin@admin.com',
                'password' => $password,
                'role_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        if (DB::table('roles')->count() == 0) {
                # Roles
                $rolesData = [
                    [
                        'created_at' => date('Y-m-d H:i:s'),
                        'roleName' => 'Sahei Admin',
                        'permission' => '[{"menu_id":1,"title":"Settings","path":"","icon":"mdi-cogs","color":null,"parent_id":0,"isActive":true,"sorting":0,"is_read":true,"is_create":false,"is_edit":false,"is_delete":false,"created_at":"2022-12-07T02:55:34.000000Z","updated_at":"2022-12-07T02:55:34.000000Z","deleted_at":null},{"menu_id":2,"title":"Users","path":"users","icon":"mdi-checkbox-blank-circle-outline","color":null,"parent_id":1,"isActive":true,"sorting":1,"is_read":true,"is_create":true,"is_edit":true,"is_delete":true,"created_at":"2022-12-07T03:04:59.000000Z","updated_at":"2022-12-07T03:04:59.000000Z","deleted_at":null},{"menu_id":3,"title":"Roles","path":"roles","icon":"mdi-checkbox-blank-circle-outline","color":null,"parent_id":1,"isActive":true,"sorting":2,"is_read":true,"is_create":true,"is_edit":true,"is_delete":true,"created_at":"2022-12-07T03:05:23.000000Z","updated_at":"2022-12-07T03:05:23.000000Z","deleted_at":null},{"menu_id":4,"title":"Permissions","path":"permissions","icon":"mdi-checkbox-blank-circle-outline","color":null,"parent_id":1,"isActive":true,"sorting":3,"is_read":true,"is_create":true,"is_edit":true,"is_delete":true,"created_at":"2022-12-07T03:05:48.000000Z","updated_at":"2022-12-07T03:05:48.000000Z","deleted_at":null},{"menu_id":5,"title":"Menus","path":"menus","icon":"mdi-checkbox-blank-circle-outline","color":null,"parent_id":1,"isActive":true,"sorting":4,"is_read":true,"is_create":true,"is_edit":true,"is_delete":true,"created_at":"2022-12-07T03:06:09.000000Z","updated_at":"2022-12-07T03:06:09.000000Z","deleted_at":null}]'
                    ],

                ];
        
                DB::table('roles')->insert($rolesData);
                # Roles
        }

        if (DB::table('menus')->count() == 0) {
            # Menus
            $menusData = [
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'title' => 'Settings',
                    'path' => '#1A237E',
                    'icon' => 'mdi-cog',
                    'color' => '#004D40FF',
                    'parent_id' => 0,
                    'sorting' => 1,
                    'isActive' => 1
                    
                ],
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'title' => 'Users',
                    'path' => 'users',
                    'icon' => 'mdi-checkbox-blank-circle-outline',
                    'color' => '',
                    'parent_id' => 1,
                    'sorting' => 2,
                    'isActive' => 1
                    
                ],
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'title' => 'Roles',
                    'path' => 'roles',
                    'icon' => 'mdi-checkbox-blank-circle-outline',
                    'color' => '',
                    'parent_id' => 1,
                    'sorting' => 3,
                    'isActive' => 1
                    
                ],
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'title' => 'Permissions',
                    'path' => 'permissions',
                    'icon' => 'mdi-checkbox-blank-circle-outline',
                    'color' => '',
                    'parent_id' => 1,
                    'sorting' => 4,
                    'isActive' => 1
                    
                ],
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'title' => 'Menus',
                    'path' => 'menus',
                    'icon' => 'mdi-checkbox-blank-circle-outline',
                    'color' => '',
                    'parent_id' => 1,
                    'sorting' => 5,
                    'isActive' => 1
                    
                ],

            ];
    
            DB::table('menus')->insert($menusData);
            # Menus
    }
    }
}
