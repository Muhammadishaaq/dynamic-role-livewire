<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Create roles and assign created permissions

        // Hr role
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'Employee']);

        // Create Admin user
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('password');
        $admin->email_verified_at = now();
        $admin->position = 'CEO';
        $admin->department = 'Head';
        $admin->phone_number = '1234567890';
        $admin->save();
        $admin->assignRole('Admin');

        $user = new User();
        $user->name = 'user';
        $user->email = 'user@gmail.com';
        $user->password = Hash::make('password');
        $user->email_verified_at = now();
        $user->position = 'Employee';
        $user->department = 'Head';
        $user->phone_number = '1234567890';
        $user->save();
        $user->assignRole('Employee');
    }
}
