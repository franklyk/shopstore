<?php

namespace Database\Seeders;

use App\Models\Catalog\Collection;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        Collection::factory()
            ->count(15)
            ->create();
    }
}
