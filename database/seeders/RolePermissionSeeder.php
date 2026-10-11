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

        // Roles

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

        // Permissions

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

        // HR

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

        // Commercial

        Role::findByName('commercial')->syncPermissions([
            'view dashboard',
            'view products',
            'view categories',
            'view collections',
            'view orders',
            'view shipments',
        ]);

        // Purchasing

        Role::findByName('purchasing')->syncPermissions([
            'view dashboard',
            'view products',
            'view suppliers',
            'create suppliers',
            'edit suppliers',
            'delete suppliers',
        ]);

        // Stock

        Role::findByName('stock')->syncPermissions([
            'view dashboard',
            'view products',
            'view categories',
            'view shipments',
        ]);

        // Operations

        Role::findByName('operations')->syncPermissions([
            'view dashboard',
            'view products',
            'view categories',
            'view orders',
            'view shipments',
        ]);

        // Support

        Role::findByName('support')->syncPermissions([
            'view dashboard',
            'view products',
            'view categories',
            'view collections',
            'view orders',
            'view shipments',
        ]);

        // Finance

        Role::findByName('finance')->syncPermissions([
            'view dashboard',
            'view orders',
        ]);

        // Marketing

        Role::findByName('marketing')->syncPermissions([
            'view dashboard',
            'view products',
            'view categories',
            'view collections',
        ]);

        // Administration

        Role::findByName('administration')->syncPermissions(
            Permission::all()
        );

        // Owner

        Role::findByName('owner')->syncPermissions(
            Permission::all()
        );

        // Super Admin

        Role::findByName('super-admin')->syncPermissions(
            Permission::all()
        );

        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();
    }
}
