<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function (User $user) {

            Address::factory()
                ->count(rand(1, 3))
                ->create([
                    'user_id' => $user->id,
                    'is_default' => false,
                ]);

            $user->addresses()
                ->inRandomOrder()
                ->first()
                ?->update([
                    'is_default' => true,
                ]);
        });
    }
}
