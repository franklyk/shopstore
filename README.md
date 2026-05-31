🌳 ÁRVORE DE IMPLEMENTAÇÃO DA APLICAÇÃO
Status do Projeto

Legenda:
✅ Concluído
🟡 Parcial
⬜ Não iniciado
❓ A confirmar

━━━━━━━━━━━━━━━━━━━
FASE 1 — Fundação do Sistema
━━━━━━━━━━━━━━━━━━━

Sistema
├── ✅ Configuração do Laravel
├── ✅ Banco de dados
├── ✅ Migrations
├── ✅ Models principais
├── ✅ Layout base
├── ✅ Autenticação
├── ✅ Controle de acesso (Roles/Permissions)
└── ✅ Estrutura básica de rotas

━━━━━━━━━━━━━━━━━━━
FASE 2 — Usuários e Segurança
━━━━━━━━━━━━━━━━━━━

Autenticação
├── ✅ Login
├── ✅ Logout
├── ✅ Registro
├── ✅ Recuperação senha
├── ✅ Middleware auth
├── ✅ Roles
└── ✅ Permissions

━━━━━━━━━━━━━━━━━━━
FASE 3 — Catálogo
━━━━━━━━━━━━━━━━━━━

Catálogo
├── ✅ Categorias
├── ✅ Produtos
│   ├── ✅ CRUD
│   ├── 🟡 Imagens
│   ├── ✅ Preço
│   ├── ✅ SKU
│   ├── ✅ Estoque inicial
│   └── ✅ Status ativo/inativo
├── ⬜ Marcas (opcional)
└── ⬜ Busca/Filtros

━━━━━━━━━━━━━━━━━━━
FASE 4 — Estrutura da Loja
━━━━━━━━━━━━━━━━━━━

Loja
├── ✅ Página inicial
├── ✅ Listagem produtos
├── ✅ Página produto
├── ✅ Carrinho
│   ├── ✅ Adicionar item
│   ├── ✅ Atualizar quantidade
│   └── ✅ Remover item
└── ✅ Sessão carrinho

━━━━━━━━━━━━━━━━━━━
FASE 5 — Entrega e Endereços
━━━━━━━━━━━━━━━━━━━

Entrega
├── 🟡 Endereços
│   ├── 🟡 CRUD endereço
│   ├── ⬜ Ownership
│   ├── ⬜ Endereço padrão
│   └── ⬜ CEP automático
├── ⬜ Métodos entrega
│   ├── ⬜ Retirada
│   ├── ⬜ Entrega local
│   └── ⬜ Transportadora
├── ⬜ Valor frete
└── ⬜ Status entrega

━━━━━━━━━━━━━━━━━━━
FASE 6 — Checkout
━━━━━━━━━━━━━━━━━━━

Checkout
├── ⬜ Resumo pedido
├── ⬜ Seleção endereço
├── ⬜ Seleção entrega
├── ⬜ Método pagamento
├── ⬜ Confirmação pedido
└── ⬜ Criação pedido

━━━━━━━━━━━━━━━━━━━
FASE 7 — Pedidos
━━━━━━━━━━━━━━━━━━━

Pedidos
├── ⬜ Order
├── ⬜ OrderItems
├── ⬜ Histórico status
├── ⬜ Status pedido
│   ├── ⬜ pending
│   ├── ⬜ paid
│   ├── ⬜ shipped
│   ├── ⬜ delivered
│   └── ⬜ cancelled
├── ⬜ Área cliente
└── ⬜ Área administrativa

━━━━━━━━━━━━━━━━━━━
FASE 8 — Pagamentos
━━━━━━━━━━━━━━━━━━━

Pagamentos
├── ⬜ Pagamento manual
├── ⬜ PIX
├── ⬜ Cartão
├── ⬜ Gateway pagamento
├── ⬜ Webhook
├── ⬜ Confirmação pagamento
└── ⬜ Estorno

━━━━━━━━━━━━━━━━━━━
FASE 9 — Estoque
━━━━━━━━━━━━━━━━━━━

Estoque
├── ⬜ Movimentações
│   ├── ⬜ Entrada
│   ├── ⬜ Venda
│   ├── ⬜ Ajuste
│   └── ⬜ Cancelamento
├── ⬜ Saldo produto
├── ⬜ Histórico
├── ⬜ Reserva estoque
└── ⬜ Estoque mínimo

━━━━━━━━━━━━━━━━━━━
FASE 10 — Caixa / Financeiro
━━━━━━━━━━━━━━━━━━━

Financeiro
├── ⬜ Caixa
├── ⬜ Abertura caixa
├── ⬜ Fechamento caixa
├── ⬜ Movimentações
├── ⬜ Recebimentos
├── ⬜ Despesas
├── ⬜ Relatórios
└── ⬜ Fluxo caixa

━━━━━━━━━━━━━━━━━━━
FASE 11 — Expedição
━━━━━━━━━━━━━━━━━━━

Expedição
├── ⬜ Separação pedido
├── ⬜ Embalagem
├── ⬜ Envio
├── ⬜ Código rastreio
├── ⬜ Transportadora
└── ⬜ Atualização entrega

━━━━━━━━━━━━━━━━━━━
FASE 12 — Administração
━━━━━━━━━━━━━━━━━━━

Administração
├── 🟡 Dashboard
├── ⬜ Relatórios
├── ✅ Gestão usuários
├── ⬜ Logs
├── ⬜ Configurações
└── ⬜ Auditoria

━━━━━━━━━━━━━━━━━━━
FASE 13 — Refinamento UI/UX
━━━━━━━━━━━━━━━━━━━

Otimizações
├── 🟡 Components
├── ⬜ Design System
├── ⬜ Blade abstractions avançadas
├── 🟡 Modais
├── ⬜ AJAX
├── ⬜ Live updates
├── ⬜ Reutilização avançada
├── ⬜ UX refinada
└── ⬜ Performance frontend

━━━━━━━━━━━━━━━━━━━
FASE 14 — Automação e Integrações
━━━━━━━━━━━━━━━━━━━

Integrações
├── ⬜ Correios
├── ⬜ Melhor Envio
├── ⬜ Gateway pagamento
├── ⬜ Email transacional
├── ⬜ WhatsApp
├── ⬜ Webhooks
├── ⬜ Nota fiscal
└── ⬜ APIs externas

━━━━━━━━━━━━━━━━━━━
FASE 15 — Escalabilidade
━━━━━━━━━━━━━━━━━━━

Escalabilidade
├── ⬜ Cache
├── ⬜ Queues
├── 🟡 Eventos
├── ⬜ Jobs
├── ⬜ Observers
├── ⬜ Otimização queries
├── ⬜ CDN
└── ⬜ Monitoramento

━━━━━━━━━━━━━━━━━━━
PRÓXIMA MISSÃO RECOMENDADA
━━━━━━━━━━━━━━━━━━━

🎯 Concluir FASE 5 — Endereços

1. ✅ Endereços aparecendo no perfil
2. ⬜ CRUD completo de endereços
3. ⬜ Ownership (usuário só manipula seus endereços)
4. ⬜ Endereço padrão
5. ⬜ Integração ViaCEP
6. ⬜ Seleção de endereço para Checkout

Após isso:

➡️ FASE 6 — Checkout
➡️ FASE 7 — Pedidos

Essas duas fases formam o primeiro fluxo de negócio completo da loja:
Produto → Carrinho → Endereço → Pedido




.
├── app
│   ├── Actions
│   │   └── Orders
│   │       └── CreateOrderAction.php
│   ├── Enums
│   │   ├── PaymentStatus.php
│   │   └── ShipmentStatus.php
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Admin
│   │   │   │   ├── Category
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── Products
│   │   │   │   └── Users
│   │   │   ├── Auth
│   │   │   │   ├── EmailVerificationController.php
│   │   │   │   ├── PasswordResetController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   └── SessionController.php
│   │   │   ├── Controller.php
│   │   │   ├── OrderItemController.php
│   │   │   ├── Profile
│   │   │   │   ├── AddressController.php
│   │   │   │   ├── Orders
│   │   │   │   └── ProfileController.php
│   │   │   ├── Shipment
│   │   │   │   └── ShipmentController.php
│   │   │   ├── Store
│   │   │   │   ├── Cart
│   │   │   │   ├── Category
│   │   │   │   ├── Checkout
│   │   │   │   ├── HomeController.php
│   │   │   │   ├── Payments
│   │   │   │   └── Products
│   │   │   └── User
│   │   │       └── Profile
│   │   └── Requests
│   │       ├── Admin
│   │       │   ├── Category
│   │       │   ├── Products
│   │       │   └── Users
│   │       ├── Auth
│   │       │   ├── RegisterRequest.php
│   │       │   └── SessionRequest.php
│   │       ├── Checkout
│   │       │   └── StoreCheckoutRequest.php
│   │       ├── Orders
│   │       │   └── StoreOrderRequest.php
│   │       └── User
│   │           ├── Address
│   │           └── Profile
│   ├── Listeners
│   │   └── MergeCartOnLogin.php
│   ├── Models
│   │   ├── Address.php
│   │   ├── CartItem.php
│   │   ├── Cart.php
│   │   ├── Category.php
│   │   ├── OrderItem.php
│   │   ├── Order.php
│   │   ├── Payment.php
│   │   ├── Product.php
│   │   ├── Shipment.php
│   │   └── User.php
│   ├── Policies
│   │   ├── AddressPolicy.php
│   │   ├── CategoryPolicy.php
│   │   ├── OrderItemPolicy.php
│   │   ├── ProductPolicy.php
│   │   └── UserPolicy.php
│   ├── Providers
│   │   └── AppServiceProvider.php
│   └── Services
│       ├── CartService.php
│       ├── Payments
│       │   ├── FakeGateway.php
│       │   └── PaymentService.php
│       └── Shipment
│           └── ShipmentService.php
├── artisan
├── bootstrap
├── composer.json
├── composer.lock
├── config
├── database
│   ├── factories
│   │   ├── AddressFactory.php
│   │   ├── CategoryFactory.php
│   │   ├── OrderFactory.php
│   │   ├── OrderItemFactory.php
│   │   ├── ProductFactory.php
│   │   └── UserFactory.php
│   ├── migrations
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2026_04_20_224909_create_products_table.php
│   │   ├── 2026_04_24_235110_create_categories_table.php
│   │   ├── 2026_04_29_141805_create_category_product_table.php
│   │   ├── 2026_04_29_150617_create_carts_table.php
│   │   ├── 2026_04_29_150738_create_cart_items_table.php
│   │   ├── 2026_05_10_233402_create_permission_tables.php
│   │   ├── 2026_05_20_210403_create_addresses_table.php
│   │   ├── 2026_05_27_000003_create_orders_table.php
│   │   ├── 2026_05_27_000040_create_order_items_table.php
│   │   ├── 2026_05_28_233356_create_payments_table.php
│   │   └── 2026_05_30_215253_create_shipments_table.php
│   └── seeders
│       ├── AddressSeeder.php
│       ├── CategorySeeder.php
│       ├── DatabaseSeeder.php
│       ├── OrderItemSeeder.php
│       ├── OrderSeeder.php
│       ├── ProductSeeder.php
│       ├── RolePermissionSeeder.php
│       ├── SuperAdminSeeder.php
│       └── UserSeeder.php
├── lang
├── LICENSE
├── node_modules
├── package.json
├── package-lock.json
├── phpunit.xml
├── public
│   ├── build
│   │   ├── assets
│   │   │   ├── app-0BmDVrxS.css
│   │   │   └── app-BhycOtH4.js
│   │   └── manifest.json
│   ├── favicon.ico
│   ├── images
│   ├── index.php
│   ├── robots.txt
│   └── storage -> /var/www/lojavirtual/storage/app/public
├── README.md
├── resources
│   ├── css
│   │   └── app.css
│   ├── js
│   │   ├── app.js
│   │   ├── cart.js
│   │   └── modal
│   │       ├── create_delete.js
│   │       └── delete.js
│   ├── sass
│   │   ├── app.scss
│   │   ├── fonts
│   │   │   └── _fonts.scss
│   │   └── lib
│   │       ├── _breakpoints.scss
│   │       ├── index.scss
│   │       └── _mixins.scss
│   └── views
│       ├── admin
│       │   ├── categories
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── products
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   └── users
│       │       ├── create.blade.php
│       │       ├── edit.blade.php
│       │       ├── index.blade.php
│       │       └── show.blade.php
│       ├── auth
│       │   ├── forgot-password.blade.php
│       │   ├── login.blade.php
│       │   ├── register.blade.php
│       │   ├── reset-password.blade.php
│       │   └── verify-email.blade.php
│       ├── components
│       │   ├── admin
│       │   │   ├── forms
│       │   │   └── table
│       │   ├── buttons
│       │   │   └── button.blade.php
│       │   ├── card.blade.php
│       │   ├── detail-item.blade.php
│       │   ├── forms
│       │   │   ├── card.blade.php
│       │   │   ├── checkbox.blade.php
│       │   │   ├── error.blade.php
│       │   │   ├── field.blade.php
│       │   │   ├── flash.blade.php
│       │   │   ├── form.blade.php
│       │   │   ├── input.blade.php
│       │   │   ├── label.blade.php
│       │   │   ├── select.blade.php
│       │   │   └── textarea.blade.php
│       │   ├── icons
│       │   │   ├── check.blade.php
│       │   │   ├── edit.blade.php
│       │   │   ├── eye.blade.php
│       │   │   ├── plus.blade.php
│       │   │   ├── return.blade.php
│       │   │   └── trash.blade.php
│       │   └── modal
│       │       └── delete.blade.php
│       ├── layouts
│       │   ├── admin.blade.php
│       │   ├── auth.blade.php
│       │   ├── base.blade.php
│       │   ├── partials
│       │   │   ├── headers
│       │   │   └── sidebars
│       │   ├── profile.blade.php
│       │   └── store.blade.php
│       ├── profile
│       │   ├── addresses
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   └── index.blade.php
│       │   ├── edit.blade.php
│       │   ├── orders
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   └── show.blade.php
│       └── store
│           ├── cart
│           │   └── index.blade.php
│           ├── categories
│           │   └── index.blade.php
│           ├── checkout
│           │   └── index.blade.php
│           ├── home.blade.php
│           └── products
│               ├── index.blade.php
│               └── show.blade.php
├── routes
│   ├── console.php
│   ├── web
│   │   ├── admin.php
│   │   ├── auth.php
│   │   ├── profile.php
│   │   ├── shipment.php
│   │   └── store.php
│   └── web.php
├── storage
├── tests
├── vendor
└── vite.config.js

