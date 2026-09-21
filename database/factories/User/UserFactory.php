<?php

namespace Database\Factories\User;

use App\Models\Status\Status;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    protected $model = User::class;

    protected static int $customerNumber = 0;

    public function definition(): array
    {
        $number = ++static::$customerNumber;

        return [
            'uuid' => (string) Str::ulid(),
            'avatar' => 'avatars/user.png',
            'name' => "Cliente {$number}",
            'email' => "cliente-{$number}@email.com",
            'phone' => fake()->numerify('619########'),
            'status_id' => Status::query()
                ->where('domain', 'user')
                ->where('slug', 'pending')
                ->value('id'),
            'is_employee' => false,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            if (! $user->roles()->exists()) {
                $user->assignRole('customer');
            }
        });
    }
}
