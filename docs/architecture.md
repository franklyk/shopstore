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
