<?php

namespace Database\Seeders;

use App\Models\Department\Department;
use App\Models\Position\Position;
use App\Models\Status\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $status = Status::where('domain', 'position')
            ->where('slug', 'active')
            ->firstOrFail();

        $positions = [
            // Recursos Humanos
            [
                'department' => 'recursos-humanos',
                'name' => 'Gerente de RH',
                'description' => 'Responsável pela gestão estratégica do departamento de Recursos Humanos.',
            ],
            [
                'department' => 'recursos-humanos',
                'name' => 'Analista de RH',
                'description' => 'Atua nas atividades de análise e gestão de Recursos Humanos.',
            ],
            [
                'department' => 'recursos-humanos',
                'name' => 'Assistente de RH',
                'description' => 'Presta suporte às atividades administrativas e operacionais de Recursos Humanos.',
            ],

            // Comercial
            [
                'department' => 'comercial',
                'name' => 'Gerente Comercial',
                'description' => 'Responsável pela gestão comercial, vendas e resultados do departamento.',
            ],
            [
                'department' => 'comercial',
                'name' => 'Vendedor',
                'description' => 'Atua nas vendas, prospecção e relacionamento com clientes.',
            ],

            // Compras
            [
                'department' => 'compras',
                'name' => 'Gerente de Compras',
                'description' => 'Responsável pela gestão das compras e relacionamento com fornecedores.',
            ],
            [
                'department' => 'compras',
                'name' => 'Assistente de Compras',
                'description' => 'Presta suporte aos processos de compras e relacionamento com fornecedores.',
            ],

            // Estoque
            [
                'department' => 'estoque',
                'name' => 'Gerente de Estoque',
                'description' => 'Responsável pela gestão do estoque, inventário e movimentação de produtos.',
            ],
            [
                'department' => 'estoque',
                'name' => 'Estoquista',
                'description' => 'Atua no armazenamento, organização e movimentação de produtos.',
            ],

            // Operações
            [
                'department' => 'operacoes',
                'name' => 'Gerente de Operações',
                'description' => 'Responsável pela gestão dos processos operacionais da organização.',
            ],
            [
                'department' => 'operacoes',
                'name' => 'Assistente de Operações',
                'description' => 'Presta suporte às atividades e processos operacionais.',
            ],

            // Atendimento
            [
                'department' => 'atendimento',
                'name' => 'Gerente de Atendimento',
                'description' => 'Responsável pela gestão do atendimento e relacionamento com clientes.',
            ],
            [
                'department' => 'atendimento',
                'name' => 'Atendente',
                'description' => 'Atua no atendimento e suporte aos clientes.',
            ],

            // Financeiro
            [
                'department' => 'financeiro',
                'name' => 'Gerente Financeiro',
                'description' => 'Responsável pela gestão financeira da organização.',
            ],
            [
                'department' => 'financeiro',
                'name' => 'Analista Financeiro',
                'description' => 'Atua na análise e controle das atividades financeiras.',
            ],
            [
                'department' => 'financeiro',
                'name' => 'Assistente Financeiro',
                'description' => 'Presta suporte às atividades administrativas e financeiras.',
            ],

            // Marketing
            [
                'department' => 'marketing',
                'name' => 'Gerente de Marketing',
                'description' => 'Responsável pela gestão das estratégias e ações de marketing.',
            ],
            [
                'department' => 'marketing',
                'name' => 'Analista de Marketing',
                'description' => 'Atua no planejamento, análise e execução de ações de marketing.',
            ],
            [
                'department' => 'marketing',
                'name' => 'Assistente de Marketing',
                'description' => 'Presta suporte às atividades e campanhas de marketing.',
            ],

            // Administração
            [
                'department' => 'administracao',
                'name' => 'Administrador',
                'description' => 'Responsável pela administração geral e gestão estratégica da organização.',
            ],
        ];

        foreach ($positions as $position) {
            $department = Department::where(
                'slug',
                $position['department']
            )->firstOrFail();

            Position::create([
                'department_id' => $department->id,
                'name' => $position['name'],
                'slug' => Str::slug($position['name']),
                'description' => $position['description'],
                'status_id' => $status->id,
            ]);
        }
    }
}
