<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $activeStatus = Status::query()
            ->where('domain', 'user')
            ->where('slug', 'active')
            ->value('id');

        if (!$activeStatus) {
            throw new \RuntimeException(
                'O status ativo do domínio user não foi encontrado.'
            );
        }

        // Posições
        $positions = Position::query()
            ->whereIn('slug', [
                'administrador',
                'gerente-de-rh',
                'gerente-comercial',
                'gerente-de-estoque',
                'analista-de-rh',
                'vendedor',
                'estoquista',
            ])
            ->get()
            ->keyBy('slug');

        // Owner
        $owner = User::updateOrCreate(
            ['email' => 'owner@shopstore.local'],
            [
                'uuid' => (string) Str::ulid(),
                'name' => 'Owner',
                'status_id' => $activeStatus,
                'is_employee' => true,
                'email_verified_at' => now(),
                'password' => 'password',
            ]
        );

        $owner->syncRoles(['owner']);

        // Super Admin
        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@shopstore.local'],
            [
                'uuid' => (string) Str::ulid(),
                'name' => 'Super Admin',
                'status_id' => $activeStatus,
                'is_employee' => true,
                'email_verified_at' => now(),
                'password' => 'password',
            ]
        );

        $superAdmin->syncRoles(['super-admin']);

        $superAdmin->positions()->syncWithoutDetaching([
            $this->positionId($positions, 'administrador'),
        ]);

        // Gerente de RH
        $this->createEmployee(
            name: 'Gerente de RH',
            email: 'rh.manager@shopstore.com',
            statusId: $activeStatus,
            role: 'hr',
            positionId: $this->positionId($positions, 'gerente-de-rh'),
        );

        // Gerente Comercial
        $this->createEmployee(
            name: 'Gerente Comercial',
            email: 'comercial.manager@shopstore.com',
            statusId: $activeStatus,
            role: 'commercial',
            positionId: $this->positionId($positions, 'gerente-comercial'),
        );

        // Gerente de Estoque
        $this->createEmployee(
            name: 'Gerente de Estoque',
            email: 'estoque.manager@shopstore.com',
            statusId: $activeStatus,
            role: 'stock',
            positionId: $this->positionId($positions, 'gerente-de-estoque'),
        );

        // Analista de RH
        $this->createEmployee(
            name: 'Analista de RH',
            email: 'rh.analyst@shopstore.com',
            statusId: $activeStatus,
            role: 'hr',
            positionId: $this->positionId($positions, 'analista-de-rh'),
        );

        // Vendedor
        $this->createEmployee(
            name: 'Vendedor',
            email: 'vendedor@shopstore.com',
            statusId: $activeStatus,
            role: 'commercial',
            positionId: $this->positionId($positions, 'vendedor'),
        );

        // Estoquista
        $this->createEmployee(
            name: 'Estoquista',
            email: 'estoquista@shopstore.com',
            statusId: $activeStatus,
            role: 'stock',
            positionId: $this->positionId($positions, 'estoquista'),
        );

        // Clientes de teste
        User::factory(100)->create();
    }

    private function createEmployee(
        string $name,
        string $email,
        int $statusId,
        string $role,
        int $positionId,
    ): User {
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'uuid' => (string) Str::ulid(),
                'name' => $name,
                'status_id' => $statusId,
                'is_employee' => true,
                'email_verified_at' => now(),
                'password' => 'password',
            ]
        );

        $user->syncRoles([$role]);

        $user->positions()->syncWithoutDetaching([$positionId]);

        return $user;
    }

    private function positionId(Collection $positions, string $slug): int
    {
        $position = $positions->get($slug);

        if (!$position) {
            throw new \RuntimeException(
                "A posição '{$slug}' não foi encontrada. Execute o PositionSeeder antes do UserSeeder."
            );
        }

        return $position->id;
    }
}
