<?php

namespace Database\Seeders;

use App\Models\Status\Status;
use App\Models\Supplier\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $defaultStatus = Status::query()
            ->where('domain', 'supplier')
            ->where('is_default', true)
            ->value('id');

        for ($i = 1; $i <= 5; $i++) {

            Supplier::updateOrCreate(
                ['slug' => "fornecedor-{$i}"],
                [
                    'uuid' => (string) Str::ulid(),
                    'name' => "Fornecedor {$i}",
                    'status_id' => $defaultStatus,
                ]
            );
        }
    }
}
