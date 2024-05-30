<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create_user', 'guard_name' => 'web']);
        Permission::create(['name' => 'update_user', 'guard_name' => 'web']);
        Permission::create(['name' => 'read_user', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete_user', 'guard_name' => 'web']);

        Permission::create(['name' => 'create_role', 'guard_name' => 'web']);
        Permission::create(['name' => 'update_role', 'guard_name' => 'web']);
        Permission::create(['name' => 'read_role', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete_role', 'guard_name' => 'web']);
        
        Permission::create(['name' => 'create_permission', 'guard_name' => 'web']);
        Permission::create(['name' => 'update_permission', 'guard_name' => 'web']);
        Permission::create(['name' => 'read_permission', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete_permission', 'guard_name' => 'web']);
    }
}
