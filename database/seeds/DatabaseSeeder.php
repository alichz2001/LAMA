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
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminadmin'),
        ]);
        \Illuminate\Support\Facades\DB::table('roles')->insert([
            'title' => 'super admin',
            'sys_title' => 'super_admin',
        ]);
        \Illuminate\Support\Facades\DB::table('modules')->insert([
            'title' => 'dashboard',
            'sys_title' => 'dashboard',
        ]);
        \Illuminate\Support\Facades\DB::table('modules')->insert([
            'title' => 'admin management',
            'sys_title' => 'admin_management',
        ]);
        \Illuminate\Support\Facades\DB::table('modules')->insert([
            'title' => 'admins list',
            'sys_title' => 'admins_list',
            'has_parent' => 1,
            'parent_id' => 2
        ]);

        \Illuminate\Support\Facades\DB::table('role__module')->insert([
            'module_id' => 1,
            'role_id' => 1
        ]);
        \Illuminate\Support\Facades\DB::table('role__module')->insert([
            'module_id' => 2,
            'role_id' => 1
        ]);
        \Illuminate\Support\Facades\DB::table('role__module')->insert([
            'module_id' => 3,
            'role_id' => 1
        ]);

        \Illuminate\Support\Facades\DB::table('companies')->insert([
            'title' => 'first company',
            'sys_title' => 'first_company'
        ]);

        \Illuminate\Support\Facades\DB::table('user__role__company')->insert([
            'user_id' => 1,
            'role_id' => 1,
            'company_id' => 1
        ]);
    }
}
