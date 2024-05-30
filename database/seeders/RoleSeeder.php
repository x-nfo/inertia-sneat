<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $superadmin = Role::create(['name' => 'superadmin', 'guard_name' => 'web']);

        // $superadmin->givePermissionTo([
        //     'read_user', 'create_user', 'update_user', 'delete_user',
        //     'read_role', 'create_role', 'update_role', 'delete_role',
        //     'read_permission', 'create_permission', 'update_permission', 'delete_permission',

        // ]);
        
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);

        $admin->givePermissionTo([ 'delete_user',
            'update_user',
            'read_user',
            'create_user',
            'read_role',
            'read_permission',]);

        $operator = Role::create(['name' => 'operator', 'guard_name' => 'web']);

        $operator->givePermissionTo([
            'read_user',
            'create_user',
            'read_role',
            'read_permission',
        ]);
    }
}
