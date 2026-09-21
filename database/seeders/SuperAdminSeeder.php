<?php

namespace Database\Seeders;

use App\Models\Status\Status;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $activeStatus = Status::query()
            ->where('domain', 'user')
            ->where('slug', 'active')
            ->value('id');

        $user = User::firstOrCreate(
            [
                'email' => 'superadmin@email.com',
            ],
            [
                'uuid' => (string) Str::ulid(),
                'name' => 'Super Admin',
                'status_id' => $activeStatus,
                'is_employee' => true,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );

        $user->assignRole('super-admin');
    }
}
