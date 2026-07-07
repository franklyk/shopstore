<?php

namespace Database\Seeders;

use App\Models\Catalog\Collection;
use App\Models\Status\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $statusId = Status::query()
            ->where('domain', 'collection')
            ->where('is_default', true)
            ->value('id');

        $collections = [
            'Destaques',
            'Novidades',
            'Promoções',
            'Mais Vendidos',
            'Lançamentos',
        ];

        foreach ($collections as $collection) {

            Collection::updateOrCreate(
                ['slug' => str($collection)->slug()],
                [
                    'uuid' => (string) Str::ulid(),
                    'name' => $collection,
                    'status_id' => $statusId,
                ]
            );
        }
    }
}
