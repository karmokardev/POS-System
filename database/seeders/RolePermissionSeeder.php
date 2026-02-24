<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $cashier = Role::firstOrCreate(['name' => 'Cashier']);

        $permissions = [
            'product.create',
            'product.view',
            'sale.create',
            'report.view',
            'user.manage'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin->syncPermissions(Permission::all());

        $manager->syncPermissions([
            'product.view',
            'sale.create',
            'report.view'
        ]);

        $cashier->syncPermissions([
            'sale.create'
        ]);
    }
}
