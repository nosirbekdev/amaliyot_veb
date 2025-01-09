<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);

        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'read']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'delete']);

        $role = Role::findByName('admin');
        $role->givePermissionTo('create', 'read', 'update', 'delete');

        $role = Role::findByName('user');
        $role->givePermissionTo('read');
    }
}
