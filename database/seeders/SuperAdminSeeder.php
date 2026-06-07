<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // ===================//
        // Super-Administrador//
        // ===================//

        $user = User::firstOrCreate(
            [
                'email' => 'superadmin@email.com',
            ],
            [
                'name' => 'Super Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );

        $user->assignRole('super-admin');
    }
}
