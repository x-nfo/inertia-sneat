<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::factory()->create(['email' => 'superadmin@gmail.com']);

        $superadmin->assignRole('Super Admin');

        $admin = User::factory()->create([ 'email' => 'admin@gmail.com']);

        $admin->assignRole('Admin');

        $operator = User::factory()->create(['email' => 'operator@gmail.com']);

        $operator->assignRole('Operator');
    }
}
