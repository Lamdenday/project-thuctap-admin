<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'user_list', 'display_name' => 'User List', 'group_name' => 'user'],
            ['name' => 'user_create', 'display_name' => 'User Create', 'group_name' => 'user'],
            ['name' => 'user_edit', 'display_name' => 'User Edit', 'group_name' => 'user'],
            ['name' => 'user_delete', 'display_name' => 'User Delete', 'group_name' => 'user'],

            ['name' => 'role_list', 'display_name' => 'Role List', 'group_name' => 'role'],
            ['name' => 'role_create', 'display_name' => 'Role Create', 'group_name' => 'role'],
            ['name' => 'role_edit', 'display_name' => 'Role Edit', 'group_name' => 'role'],
            ['name' => 'role_delete', 'display_name' => 'Role Delete', 'group_name' => 'role'],

            ['name' => 'product_list', 'display_name' => 'Product List', 'group_name' => 'product'],
            ['name' => 'product_create', 'display_name' => 'Product Create', 'group_name' => 'product'],
            ['name' => 'product_edit', 'display_name' => 'Product Edit', 'group_name' => 'product'],
            ['name' => 'product_delete', 'display_name' => 'Product Delete', 'group_name' => 'product'],

            ['name' => 'category_list', 'display_name' => 'Category List', 'group_name' => 'category'],
            ['name' => 'category_create', 'display_name' => 'Category Create', 'group_name' => 'category'],
            ['name' => 'category_edit', 'display_name' => 'Category Edit', 'group_name' => 'category'],
            ['name' => 'category_delete', 'display_name' => 'Category Delete', 'group_name' => 'category'],
        ];
        Permission::insert($permissions);
    }
}
