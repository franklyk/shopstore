<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $status = Status::where('domain', 'department')
            ->where('slug', 'active')
            ->firstOrFail();

        $departments = [
            [
                'name' => 'Recursos Humanos',
                'description' => 'Responsável pela gestão de pessoas, recrutamento, desenvolvimento e administração de colaboradores.',
            ],
            [
                'name' => 'Comercial',
                'description' => 'Responsável pelas vendas, relacionamento com clientes e resultados comerciais.',
            ],
            [
                'name' => 'Compras',
                'description' => 'Responsável pela aquisição de produtos, negociação com fornecedores e gestão de compras.',
            ],
            [
                'name' => 'Estoque',
                'description' => 'Responsável pelo controle, armazenamento, movimentação e inventário de produtos.',
            ],
            [
                'name' => 'Operações',
                'description' => 'Responsável pelos processos operacionais e pela execução das atividades internas.',
            ],
            [
                'name' => 'Atendimento',
                'description' => 'Responsável pelo atendimento, suporte e relacionamento com clientes.',
            ],
            [
                'name' => 'Financeiro',
                'description' => 'Responsável pela gestão financeira, contas, pagamentos, recebimentos e controles financeiros.',
            ],
            [
                'name' => 'Marketing',
                'description' => 'Responsável pela comunicação, divulgação, campanhas e estratégias de marketing.',
            ],
            [
                'name' => 'Administração',
                'description' => 'Responsável pela administração geral e gestão estratégica da organização.',
            ],
        ];

        foreach ($departments as $department) {
            Department::create([
                'name' => $department['name'],
                'slug' => Str::slug($department['name']),
                'description' => $department['description'],
                'status_id' => $status->id,
            ]);
        }
    }
}
