<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Categorias Principais
        |--------------------------------------------------------------------------
        */

        $informatica = Category::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Informática',
            'slug' => 'informatica',
        ]);

        $celulares = Category::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Celulares',
            'slug' => 'celulares',
        ]);

        $games = Category::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Games',
            'slug' => 'games',
        ]);

        $perifericos = Category::create([
            'uuid' => (string) Str::ulid(),
            'name' => 'Periféricos',
            'slug' => 'perifericos',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Subcategorias - Informática
        |--------------------------------------------------------------------------
        */

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $informatica->id,
            'name' => 'Notebooks',
            'slug' => 'notebooks',
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $informatica->id,
            'name' => 'Monitores',
            'slug' => 'monitores',
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $informatica->id,
            'name' => 'Impressoras',
            'slug' => 'impressoras',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Subcategorias - Celulares
        |--------------------------------------------------------------------------
        */

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $celulares->id,
            'name' => 'Smartphones',
            'slug' => 'smartphones',
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $celulares->id,
            'name' => 'Capas',
            'slug' => 'capas',
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $celulares->id,
            'name' => 'Carregadores',
            'slug' => 'carregadores',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Subcategorias - Games
        |--------------------------------------------------------------------------
        */

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $games->id,
            'name' => 'Consoles',
            'slug' => 'consoles',
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $games->id,
            'name' => 'Jogos',
            'slug' => 'jogos',
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $games->id,
            'name' => 'Acessórios Gamer',
            'slug' => 'acessorios-gamer',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Subcategorias - Periféricos
        |--------------------------------------------------------------------------
        */

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $perifericos->id,
            'name' => 'Teclados',
            'slug' => 'teclados',
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $perifericos->id,
            'name' => 'Mouses',
            'slug' => 'mouses',
        ]);

        Category::create([
            'uuid' => (string) Str::ulid(),
            'parent_id' => $perifericos->id,
            'name' => 'Headsets',
            'slug' => 'headsets',
        ]);
    }
}