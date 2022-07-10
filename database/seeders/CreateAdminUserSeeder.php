<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '098147523',
            'password' => bcrypt('123456')
        ]);

        $role = \App\Models\Role::create([
            'name' => 'admin',
            'display_name' => 'Admin'
        ]);

        DB::table('role_user')->insert([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);
        DB::table('role_permission')->insert([
            ['permission_id' => 1, 'role_id' => $role->id],
            ['permission_id' => 2, 'role_id' => $role->id],
            ['permission_id' => 3, 'role_id' => $role->id],
            ['permission_id' => 4, 'role_id' => $role->id],

            ['permission_id' => 5, 'role_id' => $role->id],
            ['permission_id' => 6, 'role_id' => $role->id],
            ['permission_id' => 7, 'role_id' => $role->id],
            ['permission_id' => 8, 'role_id' => $role->id],

            ['permission_id' => 9, 'role_id' => $role->id],
            ['permission_id' => 10, 'role_id' => $role->id],
            ['permission_id' => 11, 'role_id' => $role->id],
            ['permission_id' => 12, 'role_id' => $role->id],

            ['permission_id' => 13, 'role_id' => $role->id],
            ['permission_id' => 14, 'role_id' => $role->id],
            ['permission_id' => 15, 'role_id' => $role->id],
            ['permission_id' => 16, 'role_id' => $role->id],
        ]);
    }
}
