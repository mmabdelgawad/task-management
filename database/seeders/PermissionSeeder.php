<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Role::create(['name' => 'user']);
        $admin = Role::create(['name' => 'admin']);

        $create = Permission::create(['name' => 'create task']);
        $update = Permission::create(['name' => 'edit task']);
        $view = Permission::create(['name' => 'view task']);
        $delete = Permission::create(['name' => 'delete task']);

        $user->syncPermissions([$create, $update, $view]);
        $admin->syncPermissions([$create, $update, $view, $delete]);
    }
}
