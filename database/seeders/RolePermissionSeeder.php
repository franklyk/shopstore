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

        $roles = [
            'hr',
            'commercial',
            'purchasing',
            'stock',
            'operations',
            'support',
            'finance',
            'marketing',
            'administration',
            'owner',
            'super-admin',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
            ]);
        }

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

            // Employees
            'view employees',
            'create employees',
            'edit employees',
            'delete employees',

            // Departments
            'view departments',
            'create departments',
            'edit departments',
            'delete departments',

            // Positions
            'view positions',
            'create positions',
            'edit positions',
            'delete positions',

            // Orders
            'view orders',

            // Shipments
            'view shipments',

            // Suppliers
            'view suppliers',
            'create suppliers',
            'edit suppliers',
            'delete suppliers',

            // Collections
            'view collections',
            'create collections',
            'edit collections',
            'delete collections',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        Role::findByName('hr')->syncPermissions([
            'view dashboard',
            'view employees',
            'create employees',
            'edit employees',
            'delete employees',
            'view departments',
            'create departments',
            'edit departments',
            'delete departments',
            'view positions',
            'create positions',
            'edit positions',
            'delete positions',
        ]);

        Role::findByName('commercial')->syncPermissions([
            'view dashboard',
            'view products',
            'view categories',
            'view collections',
            'view orders',
            'view shipments',
        ]);

        Role::findByName('purchasing')->syncPermissions([
            'view dashboard',
            'view products',
            'view suppliers',
            'create suppliers',
            'edit suppliers',
            'delete suppliers',
        ]);

        Role::findByName('stock')->syncPermissions([
            'view dashboard',
            'view products',
            'view categories',
            'view shipments',
        ]);

        Role::findByName('operations')->syncPermissions([
            'view dashboard',
            'view products',
            'view categories',
            'view orders',
            'view shipments',
        ]);

        Role::findByName('support')->syncPermissions([
            'view dashboard',
            'view products',
            'view categories',
            'view collections',
            'view orders',
            'view shipments',
        ]);

        Role::findByName('finance')->syncPermissions([
            'view dashboard',
            'view orders',
        ]);

        Role::findByName('marketing')->syncPermissions([
            'view dashboard',
            'view products',
            'view categories',
            'view collections',
        ]);

        Role::findByName('administration')->syncPermissions([
            'view dashboard',

            'view products',
            'create products',
            'edit products',
            'delete products',

            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            'view users',
            'create users',
            'edit users',
            'delete users',

            'view employees',
            'create employees',
            'edit employees',
            'delete employees',

            'view departments',
            'create departments',
            'edit departments',
            'delete departments',

            'view positions',
            'create positions',
            'edit positions',
            'delete positions',

            'view orders',
            'view shipments',

            'view suppliers',
            'create suppliers',
            'edit suppliers',
            'delete suppliers',

            'view collections',
            'create collections',
            'edit collections',
            'delete collections',
        ]);

        Role::findByName('owner')->syncPermissions(
            Permission::all()
        );

        Role::findByName('super-admin')->syncPermissions([
            'view dashboard',

            'view products',
            'create products',
            'edit products',
            'delete products',

            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            'view users',
            'create users',
            'edit users',
            'delete users',

            'view employees',
            'create employees',
            'edit employees',
            'delete employees',

            'view departments',
            'create departments',
            'edit departments',
            'delete departments',

            'view positions',
            'create positions',
            'edit positions',
            'delete positions',

            'view orders',
            'view shipments',

            'view suppliers',
            'create suppliers',
            'edit suppliers',
            'delete suppliers',

            'view collections',
            'create collections',
            'edit collections',
            'delete collections',
        ]);

        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();
    }
}
