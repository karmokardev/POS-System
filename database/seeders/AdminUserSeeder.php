<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $role = Role::firstOrCreate(['name' => 'Admin']);

        $admin = User::firstOrCreate(
            ['email' => 'hridoy@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );

        if (!$admin->hasRole('Admin')) {
            $admin->assignRole($role);
        }
    }
}