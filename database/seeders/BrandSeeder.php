<?php

namespace Database\Seeders;

use App\Models\Catalog\Brand;
use App\Models\Status\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $defaultStatus = Status::query()
            ->where('domain', 'brand')
            ->where('is_default', true)
            ->value('id');

        for ($i = 1; $i <= 5; $i++) {

            Brand::updateOrCreate(
                ['slug' => "marca-{$i}"],
                [
                    'uuid' => (string) Str::ulid(),
                    'name' => "Marca {$i}",
                    'description' => "Descrição da Marca {$i}.",
                    'website' => null,
                    'logo' => null,
                    'status_id' => $defaultStatus,
                ]
            );
        }
    }
}
