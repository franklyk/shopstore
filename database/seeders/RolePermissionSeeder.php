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
        // Roles                            //
        // ================================//

        $roles = [
            'rh',
            'comercial',
            'compras',
            'estoque',
            'operacoes',
            'atendimento',
            'financeiro',
            'marketing',
            'administracao',
            'super-admin',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
            ]);
        }

        // ================================//
        // Permissions                      //
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

            // Import Batches
            'view import batches',
            'create import batches',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        // ================================//
        // RH                               //
        // ================================//

        Role::findByName('rh')->syncPermissions([
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

        // ================================//
        // Comercial                        //
        // ================================//

        Role::findByName('comercial')->syncPermissions([
            'view dashboard',

            'view products',
            'view categories',
            'view collections',

            'view orders',
            'view shipments',
        ]);

        // ================================//
        // Compras                          //
        // ================================//

        Role::findByName('compras')->syncPermissions([
            'view dashboard',

            'view products',

            'view suppliers',
            'create suppliers',
            'edit suppliers',
            'delete suppliers',
        ]);

        // ================================//
        // Estoque                          //
        // ================================//

        Role::findByName('estoque')->syncPermissions([
            'view dashboard',

            'view products',
            'view categories',

            'view shipments',
        ]);

        // ================================//
        // Operações                        //
        // ================================//

        Role::findByName('operacoes')->syncPermissions([
            'view dashboard',

            'view products',
            'view categories',

            'view orders',
            'view shipments',
        ]);

        // ================================//
        // Atendimento                      //
        // ================================//

        Role::findByName('atendimento')->syncPermissions([
            'view dashboard',

            'view products',
            'view categories',
            'view collections',

            'view orders',
            'view shipments',
        ]);

        // ================================//
        // Financeiro                       //
        // ================================//

        Role::findByName('financeiro')->syncPermissions([
            'view dashboard',

            'view orders',
        ]);

        // ================================//
        // Marketing                        //
        // ================================//

        Role::findByName('marketing')->syncPermissions([
            'view dashboard',

            'view products',
            'view categories',
            'view collections',

            'view import batches',
        ]);

        // ================================//
        // Administração                    //
        // ================================//

        Role::findByName('administracao')->syncPermissions(
            Permission::all()
        );

        // ================================//
        // Super Admin                      //
        // ================================//

        Role::findByName('super-admin')->syncPermissions(
            Permission::all()
        );
    }
}
