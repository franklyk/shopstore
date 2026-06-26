<?php

namespace Database\Seeders;

use App\Models\User\User;
use Database\Factories\User\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // ==================//
        // Administrador    //
        // ==================//
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // ==================//
        // Gerente           //
        // ==================//
        $manager = User::create([
            'name' => 'Gerente',
            'email' => 'manager@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $manager->assignRole('manager');

        // ==================//
        // Funcionário      //
        // ==================//
        $employee = User::create([
            'name' => 'Funcionário',
            'email' => 'employee@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $employee->assignRole('employee');

        // ==================//
        // Cliente          //
        // ==================//
        $customer = User::create([
            'name' => 'Cliente',
            'email' => 'customer@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $customer->assignRole('customer');

        // ==================//
        // UserFactory      //
        // ==================//
        User::factory(100)
            ->create()
            ->each(function ($user) {
                $user->assignRole('customer');
            });
    }
}
