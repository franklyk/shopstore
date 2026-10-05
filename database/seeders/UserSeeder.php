<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activeStatus = Status::query()
            ->where('domain', 'user')
            ->where('slug', 'active')
            ->value('id');

        // ================================//
        // Posições                         //
        // ================================//

        $positions = Position::query()
            ->whereIn('slug', [
                'administrador',
                'gerente-de-rh',
                'gerente-comercial',
                'gerente-de-estoque',
                'analista-de-rh',
                'vendedor',
                'estoquista',
            ])
            ->get()
            ->keyBy('slug');

        // ================================//
        // Administrador                    //
        // ================================//

        $admin = User::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Administrador',
            'email' => 'admin@shopstore.com',
            'status_id' => $activeStatus,
            'is_employee' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('super-admin');

        $admin->positions()->attach(
            $positions['administrador']->id
        );

        // ================================//
        // Gerente de RH                    //
        // ================================//

        $hrManager = User::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Gerente de RH',
            'email' => 'rh.manager@shopstore.com',
            'status_id' => $activeStatus,
            'is_employee' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $hrManager->assignRole('rh');

        $hrManager->positions()->attach(
            $positions['gerente-de-rh']->id
        );

        // ================================//
        // Gerente Comercial                //
        // ================================//

        $commercialManager = User::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Gerente Comercial',
            'email' => 'comercial.manager@shopstore.com',
            'status_id' => $activeStatus,
            'is_employee' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $commercialManager->assignRole('comercial');

        $commercialManager->positions()->attach(
            $positions['gerente-comercial']->id
        );

        // ================================//
        // Gerente de Estoque               //
        // ================================//

        $stockManager = User::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Gerente de Estoque',
            'email' => 'estoque.manager@shopstore.com',
            'status_id' => $activeStatus,
            'is_employee' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $stockManager->assignRole('estoque');

        $stockManager->positions()->attach(
            $positions['gerente-de-estoque']->id
        );

        // ================================//
        // Analista de RH                   //
        // ================================//

        $hrAnalyst = User::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Analista de RH',
            'email' => 'rh.analyst@shopstore.com',
            'status_id' => $activeStatus,
            'is_employee' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $hrAnalyst->assignRole('rh');

        $hrAnalyst->positions()->attach(
            $positions['analista-de-rh']->id
        );

        // ================================//
        // Vendedor                         //
        // ================================//

        $seller = User::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Vendedor',
            'email' => 'vendedor@shopstore.com',
            'status_id' => $activeStatus,
            'is_employee' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $seller->assignRole('comercial');

        $seller->positions()->attach(
            $positions['vendedor']->id
        );

        // ================================//
        // Estoquista                       //
        // ================================//

        $stockEmployee = User::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Estoquista',
            'email' => 'estoquista@shopstore.com',
            'status_id' => $activeStatus,
            'is_employee' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $stockEmployee->assignRole('estoque');

        $stockEmployee->positions()->attach(
            $positions['estoquista']->id
        );

        // ================================//
        // Clientes                         //
        // ================================//

        User::factory(100)->create();
    }
}
