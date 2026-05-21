<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) {

                // 2 a 4 endereços por usuário
                $user->addresses()->createMany(
                    \App\Models\Address::factory()
                        ->count(rand(2, 4))
                        ->make()
                        ->toArray()
                );

                // define um padrão aleatório
                $user->addresses()
                    ->inRandomOrder()
                    ->first()
                    ?->update(['is_default' => true]);
            });
    }
}
