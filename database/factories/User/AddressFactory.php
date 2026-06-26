<?php

namespace Database\Factories\User;

use App\Models\User\Address;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'name' => fake()->randomElement([
                'Casa',
                'Trabalho',
                'Apartamento',
            ]),
            'cep' => fake()->numerify('#####-###'),
            'street' => fake()->streetName(),
            'number' => fake()->buildingNumber(),
            'complement' => fake()->optional()->secondaryAddress(),
            'district' => fake()->citySuffix(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'is_default' => false,
        ];
    }
}
