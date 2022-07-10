<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'LamLe',
            'email' => 'localhost@gmail.com',
            'phone' => '0963634044',
            'password' => bcrypt(12345678)
        ]);

        $role = Role::create([
            'name' => 'super_admin',
            'display_name' => 'SuperAdmin'
        ]);

        DB::table('role_user')->insert([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);

        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            DB::table('role_permission')->insert([
                'permission_id' => $permission->id,
                'role_id' => $role->id
            ]);
        }
    }
}
