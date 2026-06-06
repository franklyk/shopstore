<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();

        // ================================//
        // Roles                          //
        // ================================//

        $customer = Role::firstOrCreate([
            'name' => 'customer',
        ]);

        $employee = Role::firstOrCreate([
            'name' => 'employee',
        ]);

        $manager = Role::firstOrCreate([
            'name' => 'manager',
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'admin',
        ]);

        Role::firstOrCreate([
            'name' => 'super-admin',
        ]);

        // ================================//
        // Permissions                    //
        // ================================//

        $permissions = [

            // Dashboard
            'view dashboard',

            // Products
            'view products',
            'create products',
            'edit products',
            'delete products',

            // Categories
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            // Users
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Orders
            'view orders'

        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        // ================================//
        // Customer Permissions           //
        // ================================//
        $customer->givePermissionTo([]);

        // ================================//
        // Employee Permissions           //
        // ================================//
        $employee->givePermissionTo([

            'view dashboard',

            'view products',
            'view categories',

        ]);

        // ================================//
        // Manager Permissions            //
        // ================================//
        $manager->givePermissionTo([

            'view dashboard',

            'view products',
            'create products',
            'edit products',

            'view categories',
            'create categories',
            'edit categories',

            'view users',

            'view orders'

        ]);

        // ================================//
        // Admin Permissions              //
        // ================================//
        $admin->givePermissionTo(
            Permission::all()
        );
    }
}
