<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use App\Models\Status;
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
                'description' => 'Responsável pela gestão do departamento de Recursos Humanos, planejamento das atividades da área, acompanhamento da equipe e definição das políticas e processos relacionados aos funcionários.',
            ],

            [
                'department' => 'recursos-humanos',
                'name' => 'Analista de RH',
                'description' => 'Atua nos processos de Recursos Humanos, incluindo recrutamento, seleção, acompanhamento de funcionários, organização de documentos e apoio às rotinas de gestão de pessoas.',
            ],

            [
                'department' => 'recursos-humanos',
                'name' => 'Assistente de RH',
                'description' => 'Presta suporte às rotinas administrativas de Recursos Humanos, auxiliando na organização de documentos, cadastro de funcionários, controle de informações e atendimento às demandas internas.',
            ],

            // Comercial

            [
                'department' => 'comercial',
                'name' => 'Gerente Comercial',
                'description' => 'Responsável pela gestão da equipe comercial, definição de estratégias de vendas, acompanhamento dos resultados e desenvolvimento das ações para aumentar as vendas e a carteira de clientes.',
            ],

            [
                'department' => 'comercial',
                'name' => 'Vendedor',
                'description' => 'Realiza atendimento comercial, apresenta produtos, identifica as necessidades dos clientes, negocia condições de venda, registra pedidos e acompanha oportunidades comerciais.',
            ],

            // Compras

            [
                'department' => 'compras',
                'name' => 'Gerente de Compras',
                'description' => 'Responsável pelo planejamento e gestão das compras, negociação com fornecedores, acompanhamento das necessidades de reposição e controle das condições comerciais de aquisição dos produtos.',
            ],

            [
                'department' => 'compras',
                'name' => 'Assistente de Compras',
                'description' => 'Presta suporte aos processos de compras, realizando cotações, organização de pedidos, atualização de informações de fornecedores e acompanhamento das solicitações de aquisição.',
            ],

            // Estoque

            [
                'department' => 'estoque',
                'name' => 'Gerente de Estoque',
                'description' => 'Responsável pela gestão do estoque, organização dos produtos, controle de inventário, acompanhamento das movimentações e definição de procedimentos para garantir a disponibilidade e integridade dos produtos.',
            ],

            [
                'department' => 'estoque',
                'name' => 'Estoquista',
                'description' => 'Realiza o recebimento, conferência, armazenamento, organização, separação e movimentação de produtos, mantendo o estoque identificado e organizado.',
            ],

            // Operações

            [
                'department' => 'operacoes',
                'name' => 'Gerente de Operações',
                'description' => 'Responsável pelo acompanhamento e gestão dos processos operacionais da empresa, coordenando o fluxo de trabalho entre os departamentos e buscando garantir eficiência, organização e cumprimento dos procedimentos internos.',
            ],

            [
                'department' => 'operacoes',
                'name' => 'Assistente de Operações',
                'description' => 'Auxilia no acompanhamento dos processos operacionais, organiza informações e documentos, acompanha o fluxo de pedidos e presta suporte às equipes envolvidas nas atividades diárias da empresa.',
            ],

            // Atendimento

            [
                'department' => 'atendimento',
                'name' => 'Gerente de Atendimento',
                'description' => 'Responsável pela gestão da equipe de atendimento, definição dos procedimentos de atendimento, acompanhamento da qualidade do serviço e tratamento das demandas e reclamações dos clientes.',
            ],

            [
                'department' => 'atendimento',
                'name' => 'Atendente',
                'description' => 'Realiza o atendimento aos clientes, esclarece dúvidas, fornece informações sobre produtos e pedidos, registra solicitações e encaminha demandas para os departamentos responsáveis.',
            ],

            // Financeiro

            [
                'department' => 'financeiro',
                'name' => 'Gerente Financeiro',
                'description' => 'Responsável pela gestão financeira da empresa, acompanhamento do fluxo de caixa, planejamento financeiro, controle das receitas e despesas e supervisão das atividades do departamento.',
            ],

            [
                'department' => 'financeiro',
                'name' => 'Analista Financeiro',
                'description' => 'Atua no controle e análise das movimentações financeiras, acompanhamento de contas a pagar e receber, conciliação de informações e elaboração de relatórios financeiros.',
            ],

            [
                'department' => 'financeiro',
                'name' => 'Assistente Financeiro',
                'description' => 'Presta suporte às rotinas financeiras, auxiliando no lançamento e organização de documentos, controle de pagamentos e recebimentos e atualização das informações financeiras.',
            ],

            // Marketing

            [
                'department' => 'marketing',
                'name' => 'Gerente de Marketing',
                'description' => 'Responsável pelo planejamento e gestão das estratégias de marketing, definição de campanhas, acompanhamento dos resultados e posicionamento da empresa e de seus produtos.',
            ],

            [
                'department' => 'marketing',
                'name' => 'Analista de Marketing',
                'description' => 'Atua no planejamento, execução e análise de campanhas de marketing, produção de informações para as ações comerciais e acompanhamento dos resultados das estratégias de divulgação.',
            ],

            [
                'department' => 'marketing',
                'name' => 'Assistente de Marketing',
                'description' => 'Presta suporte na execução de campanhas e ações de marketing, organização de materiais, atualização de conteúdos e acompanhamento das atividades de divulgação.',
            ],

            // Administração

            [
                'department' => 'administracao',
                'name' => 'Administrador',
                'description' => 'Responsável pela administração geral da empresa, acompanhamento dos processos administrativos, integração entre os departamentos e apoio à gestão estratégica e operacional da organização.',
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
