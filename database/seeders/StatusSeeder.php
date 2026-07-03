<?php

namespace Database\Seeders;

use App\Models\Status\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::upsert([
            // Products
            [
                'domain' => 'product',
                'name' => 'Ativo',
                'slug' => 'active',
                'color' => 'success',
                'sort_order' => 1,
                'is_default' => true,
                'active' => true,
            ],
            [
                'domain' => 'product',
                'name' => 'Inativo',
                'slug' => 'inactive',
                'color' => 'secondary',
                'sort_order' => 2,
                'is_default' => false,
                'active' => true,
            ],
            [
                'domain' => 'product',
                'name' => 'Em homologação',
                'slug' => 'homologation',
                'color' => 'warning',
                'sort_order' => 3,
                'is_default' => false,
                'active' => true,
            ],

            // Categories
            [
                'domain' => 'category',
                'name' => 'Ativa',
                'slug' => 'active',
                'color' => 'success',
                'sort_order' => 1,
                'is_default' => true,
                'active' => true,
            ],
            [
                'domain' => 'category',
                'name' => 'Inativa',
                'slug' => 'inactive',
                'color' => 'secondary',
                'sort_order' => 2,
                'is_default' => false,
                'active' => true,
            ],

            // Collections
            [
                'domain' => 'collection',
                'name' => 'Publicada',
                'slug' => 'published',
                'color' => 'success',
                'sort_order' => 1,
                'is_default' => true,
                'active' => true,
            ],
            [
                'domain' => 'collection',
                'name' => 'Oculta',
                'slug' => 'hidden',
                'color' => 'dark',
                'sort_order' => 2,
                'is_default' => false,
                'active' => true,
            ],

            // Users
            [
                'domain' => 'user',
                'name' => 'Ativo',
                'slug' => 'active',
                'color' => 'success',
                'sort_order' => 1,
                'is_default' => true,
                'active' => true,
            ],
            [
                'domain' => 'user',
                'name' => 'Bloqueado',
                'slug' => 'blocked',
                'color' => 'danger',
                'sort_order' => 2,
                'is_default' => false,
                'active' => true,
            ],
            [
                'domain' => 'user',
                'name' => 'Pendente',
                'slug' => 'pending',
                'color' => 'warning',
                'sort_order' => 3,
                'is_default' => false,
                'active' => true,
            ],

        ], ['domain', 'slug']);
    }
}
