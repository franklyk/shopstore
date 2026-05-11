<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        //================================//
        // Roles                          //
        //================================//

        $customer = Role::firstOrCreate([
            'name' => 'customer'
        ]);

        $employee = Role::firstOrCreate([
            'name' => 'employee'
        ]);

        $manager = Role::firstOrCreate([
            'name' => 'manager'
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        //================================//
        // Permissions                    //
        //================================//

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

        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        //================================//
        // Customer Permissions           //
        //================================//

        $customer->givePermissionTo([]);

        //================================//
        // Employee Permissions           //
        //================================//

        $employee->givePermissionTo([

            'view dashboard',

            'view products',
            'view categories',

        ]);

        //================================//
        // Manager Permissions            //
        //================================//

        $manager->givePermissionTo([

            'view dashboard',

            'view products',
            'create products',
            'edit products',

            'view categories',
            'create categories',
            'edit categories',

            'view users',

        ]);

        //================================//
        // Admin Permissions              //
        //================================//

        $admin->givePermissionTo(
            Permission::all()
        );
    }
}