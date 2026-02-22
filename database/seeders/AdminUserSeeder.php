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
        // Admin role না থাকলে তৈরি করবে
        $role = Role::firstOrCreate(['name' => 'Admin']);

        // Admin user তৈরি বা আগে থাকলে আপডেট করবে না
        $admin = User::firstOrCreate(
            ['email' => 'hridoy@gmail.com'], // unique email
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );

        // role assign (duplicate হবে না)
        if (!$admin->hasRole('Admin')) {
            $admin->assignRole($role);
        }
    }
}