<?php

namespace Database\Seeders;

use App\Models\SystemInstallation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SystemInstallationSeeder extends Seeder
{
    public function run(): void
    {
        SystemInstallation::query()->firstOrCreate(
            [],
            [
                'uuid' => (string) Str::uuid(),
                'status' => 'pending',
                'initialized_at' => null,
            ]
        );
    }
}
