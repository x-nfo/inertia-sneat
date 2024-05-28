<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);
        
        $admin = Role::create(['name' => 'Admin', 'guard_name' => 'web']);

        $admin->givePermissionTo([ 'delete user',
            'update user',
            'read user',
            'create user',
            'read role',
            'read permission',]);

        $operator = Role::create(['name' => 'Operator', 'guard_name' => 'web']);

        $operator->givePermissionTo([
            'read user',
            'create user',
            'read role',
            'read permission',
        ]);
    }
}
