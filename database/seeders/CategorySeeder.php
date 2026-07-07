<?php

namespace Database\Seeders;

use App\Models\Catalog\Category;
use App\Models\Status\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $statusId = Status::query()
            ->where('domain', 'category')
            ->where('is_default', true)
            ->value('id');

        $informatica = Category::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Informática',
            'slug' => 'informatica',
            'status_id' => $statusId,
        ]);

        $celulares = Category::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Celulares',
            'slug' => 'celulares',
            'status_id' => $statusId,
        ]);

        $games = Category::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Games',
            'slug' => 'games',
            'status_id' => $statusId,
        ]);

        $perifericos = Category::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Periféricos',
            'slug' => 'perifericos',
            'status_id' => $statusId,
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $informatica->id,
            'name' => 'Notebooks',
            'slug' => 'notebooks',
            'status_id' => $statusId,
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $informatica->id,
            'name' => 'Monitores',
            'slug' => 'monitores',
            'status_id' => $statusId,
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $informatica->id,
            'name' => 'Impressoras',
            'slug' => 'impressoras',
            'status_id' => $statusId,
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $celulares->id,
            'name' => 'Smartphones',
            'slug' => 'smartphones',
            'status_id' => $statusId,
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $celulares->id,
            'name' => 'Capas',
            'slug' => 'capas',
            'status_id' => $statusId,
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $celulares->id,
            'name' => 'Carregadores',
            'slug' => 'carregadores',
            'status_id' => $statusId,
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $games->id,
            'name' => 'Consoles',
            'slug' => 'consoles',
            'status_id' => $statusId,
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $games->id,
            'name' => 'Jogos',
            'slug' => 'jogos',
            'status_id' => $statusId,
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $games->id,
            'name' => 'Acessórios Gamer',
            'slug' => 'acessorios-gamer',
            'status_id' => $statusId,
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $perifericos->id,
            'name' => 'Teclados',
            'slug' => 'teclados',
            'status_id' => $statusId,
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $perifericos->id,
            'name' => 'Mouses',
            'slug' => 'mouses',
            'status_id' => $statusId,
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $perifericos->id,
            'name' => 'Headsets',
            'slug' => 'headsets',
            'status_id' => $statusId,
        ]);
    }
}
