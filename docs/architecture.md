# Arquitetura do ShopStore

## 1. Fluxo-mestre de implantação

O desenvolvimento do ShopStore segue a simulação progressiva da implantação de uma empresa real.

### 01. Fundação

* Owner
* Super Admin
* Usuários
* Roles
* Permissions

### 02. Administração

* Responsável técnico
* Administrador operacional
* Configurações

### 03. Estrutura organizacional

* Departamentos
* Cargos
* Funcionários

### 04. Operação inicial

* Fornecedores
* Armazéns
* Categorias
* Marcas
* Coleções
* Produtos

### 05. Primeiro recebimento

* Compras
* Recebimento de estoque
* Estoque

### 06. Primeira venda

* Cliente
* Carrinho
* Pedido
* Pagamento

### 07. Fulfillment

* Separação
* Embalagem
* Expedição
* Entrega

### 08. Expansão

* Financeiro
* Atendimento
* Marketing
* Relatórios
* Outros módulos

### Regra de progressão

O desenvolvimento deve avançar conforme a empresa consiga executar a próxima ação real do fluxo.

O módulo atualmente em desenvolvimento não deve ser definido apenas pelo último arquivo ou Controller trabalhado, mas pela etapa atual do fluxo-mestre.

Funcionalidades pertencentes a etapas posteriores podem ser registradas como backlog, mas não devem antecipar a sequência de implantação.

Owner e Super Admin são Users identificados por Roles, não entidades ou Models independentes. Ambas as Roles possuem acesso ilimitado à aplicação, mas representam autoridades conceitualmente distintas.


┌──────────────────────────────┐
│ Empresa de tecnologia       │
│ Provisiona a instalação     │
└──────────────┬───────────────┘
               │
               │ Bootstrap Code
               ↓
┌──────────────────────────────┐
│ Proprietário                 │
│ Inicializa a empresa         │
│ Torna-se Owner               │
└──────────────┬───────────────┘
               │
               │ define
               ↓
┌──────────────────────────────┐
│ Responsável técnico          │
│ Torna-se Super Admin         │
└──────────────────────────────┘

## 2. Inicialização e recuperação da instalação

Cada instalação do ShopStore deve possuir um processo de inicialização controlado antes de permitir a criação do primeiro Owner.

A empresa de tecnologia responsável pelo provisionamento da instalação gera um **Bootstrap Code** exclusivo e o entrega fisicamente ao primeiro proprietário da aplicação.

O Bootstrap Code não representa uma conta administrativa e não deve ser utilizado como senha ou credencial permanente. Sua única finalidade é autorizar a primeira inicialização da instalação.

### 2.1. Fluxo de inicialização

```text
Instalação provisionada
        ↓
Bootstrap Code gerado
        ↓
Código entregue ao proprietário
        ↓
Proprietário informa o código
        ↓
Código validado
        ↓
Inicialização iniciada
        ↓
Cadastro do Owner
        ↓
Definição do Super Admin
        ↓
Instalação concluída
        ↓
Bootstrap Code consumido
```

### 2.2. Estados da instalação

A instalação deve possuir um estado que permita distinguir o momento do processo:

* `pending` — instalação provisionada, ainda não inicializada.
* `initializing` — Bootstrap Code validado e processo de inicialização em andamento.
* `initialized` — Owner criado, Super Admin definido e instalação concluída.

O Bootstrap Code **não deve ser consumido definitivamente no momento da validação**. A validação apenas inicia o processo de bootstrap.

O código somente será considerado definitivamente consumido quando a instalação atingir o estado `initialized`.

### 2.3. Interrupção durante a primeira inicialização

Se a inicialização for interrompida antes da conclusão, a instalação permanece no estado `initializing` e poderá retomar o processo posteriormente utilizando o mesmo Bootstrap Code, desde que este ainda seja válido.

Isso permite que uma queda de energia, falha do servidor, interrupção de conexão ou outro problema não obrigue o proprietário a solicitar um novo código.

Caso o código seja perdido, comprometido ou precise ser substituído durante essa fase, a empresa de tecnologia poderá invalidar o código atual e emitir um novo Bootstrap Code para a mesma instalação.

A substituição do código não exige recriação do banco de dados nem perda dos dados existentes.

### 2.4. Conclusão da primeira inicialização

A instalação somente poderá ser considerada `initialized` quando:

* o primeiro Owner tiver sido criado;
* a Role `Owner` tiver sido atribuída;
* o responsável técnico tiver sido definido como Super Admin;
* a instalação tiver sido marcada como concluída.

Após isso, o Bootstrap Code perde definitivamente sua função.

### 2.5. Recuperação após a instalação

Após a instalação atingir o estado `initialized`, o Bootstrap Code não poderá mais ser utilizado para criar ou substituir um Owner.

Caso ocorra perda de acesso ao Owner, mudança de propriedade da empresa ou outra situação que exija recuperação da propriedade, deverá existir um **processo específico de recuperação/transferência de propriedade**.

Esse processo é independente do Bootstrap Code e deverá permitir que a empresa de tecnologia participe somente quando necessário para validar e autorizar a recuperação, sem assumir a propriedade da instalação.

A recuperação poderá resultar na definição de um novo User como Owner:

```text
Owner atual
     ↓
Processo de recuperação/transferência
     ↓
Novo Owner
     ↓
Owner anterior perde a Role Owner
```

O User anterior não deve ser automaticamente excluído. A transferência altera a autoridade de propriedade, não a existência da conta.

### 2.6. Separação das responsabilidades

A arquitetura deve distinguir claramente três situações:

**Provisionamento**

Responsabilidade da empresa de tecnologia.

```text
Empresa de tecnologia
        ↓
Provisiona instalação
        ↓
Gera Bootstrap Code
        ↓
Entrega ao cliente
```

**Inicialização**

Responsabilidade do primeiro proprietário.

```text
Bootstrap Code
        ↓
Primeiro Owner
        ↓
Super Admin
        ↓
Instalação inicializada
```

**Administração e propriedade**

Responsabilidade do cliente.

```text
Owner
 ├── administra a propriedade
 ├── define/remover Super Admin
 └── pode transferir a propriedade

Super Admin
 └── administra tecnicamente a aplicação
```

### 2.7. Princípio fundamental

**O Bootstrap Code existe exclusivamente para iniciar uma instalação. Ele não é uma credencial permanente, não substitui o Owner e não deve ser utilizado como mecanismo de recuperação de propriedade após a instalação ter sido concluída.**

A recuperação de um Bootstrap Code durante uma inicialização interrompida e a recuperação ou transferência de propriedade após uma instalação concluída são processos distintos e devem permanecer separados na arquitetura.
