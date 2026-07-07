<?php

namespace Database\Seeders;

use App\Models\Stock\Warehouse;
use Illuminate\Database\Seeder;


class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        Warehouse::firstOrCreate(
            ['code' => 'MAIN'],
            [
                'name' => 'Principal',
                'active' => true,
            ]
        );
    }
}
