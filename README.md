# Habit Tracker

Sistema completo de rastreamento de hábitos pessoais desenvolvido com Laravel 12. Permite que usuários criem, gerenciem e acompanhem seus hábitos diários de forma simples e intuitiva.

## 🚀 Tecnologias

- **Backend**: Laravel 12
- **Frontend**: Tailwind CSS 4, Vite
- **PHP**: 8.2+
- **Banco de Dados**: MySQL/PostgreSQL/SQLite
- **Ferramentas**: Laravel Boost, Laravel Pint, Pest PHP

## ✨ Funcionalidades

- **Autenticação de Usuários**
  - Sistema de login e registro
  - Sessões seguras
  - Proteção de rotas com middleware de autenticação

- **Gerenciamento de Hábitos**
  - Criar novos hábitos
  - Editar hábitos existentes
  - Remover hábitos
  - Visualizar todos os hábitos no dashboard

- **Sistema de Logs**
  - Marcar hábitos como completos
  - Rastreamento de quantas vezes cada hábito foi realizado
  - Histórico de atividades

- **Interface Moderna**
  - Design responsivo com Tailwind CSS
  - Navegação intuitiva
  - Feedback visual para ações do usuário
  - Barra de navegação com seções: Hoje, Histórico, Calendário, Gerenciar Hábitos

## 📋 Requisitos do Sistema

Antes de começar, certifique-se de ter instalado:

- **PHP** 8.2 ou superior
- **Composer** (gerenciador de dependências PHP)
- **Node.js** 18+ e **npm**
- **Banco de Dados** (MySQL 5.7+, PostgreSQL 10+, ou SQLite 3.8.8+)
- **Extensões PHP necessárias**:
  - BCMath
  - Ctype
  - cURL
  - DOM
  - Fileinfo
  - JSON
  - Mbstring
  - OpenSSL
  - PCRE
  - PDO
  - Tokenizer
  - XML

## 🔧 Instalação

### Passo 1: Clonar o Repositório

```bash
git clone <url-do-repositorio>
cd habit-tracker
```

### Passo 2: Instalar Dependências PHP

```bash
composer install
```

### Passo 3: Instalar Dependências Node.js

```bash
npm install
```

### Passo 4: Configurar Ambiente

Copie o arquivo de exemplo de ambiente:

```bash
cp .env.example .env
```

### Passo 5: Gerar Chave da Aplicação

```bash
php artisan key:generate
```

### Passo 6: Configurar Banco de Dados

Edite o arquivo `.env` e configure as variáveis do banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=habit_tracker
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

Para SQLite (mais simples para desenvolvimento):

```env
DB_CONNECTION=sqlite
```

E crie o arquivo do banco:

```bash
touch database/database.sqlite
```

### Passo 7: Executar Migrations

```bash
php artisan migrate
```

### Passo 8: (Opcional) Executar Seeders

Para popular o banco com dados de exemplo:

```bash
php artisan db:seed
```

### Passo 9: Compilar Assets

Para desenvolvimento:

```bash
npm run dev
```

Para produção:

```bash
npm run build
```

### Passo 10: Iniciar o Servidor

```bash
php artisan serve
```

A aplicação estará disponível em `http://127.0.0.1:8000`

### Instalação Rápida (Script Automatizado)

O projeto inclui um script de setup que executa todos os passos acima:

```bash
composer run setup
```

Este comando executa:
- Instalação de dependências Composer
- Criação do arquivo .env (se não existir)
- Geração da chave da aplicação
- Execução das migrations
- Instalação de dependências npm
- Build dos assets

## ⚙️ Configuração

### Variáveis de Ambiente Importantes

No arquivo `.env`, as principais configurações são:

```env
APP_NAME="Habit Tracker"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

# Banco de Dados
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=habit_tracker
DB_USERNAME=root
DB_PASSWORD=

# Autenticação
# O Laravel usa sessões por padrão, não requer configuração adicional
```

### Configuração de Autenticação

A aplicação usa autenticação baseada em sessões do Laravel. As configurações estão em `config/auth.php` e não requerem alterações para uso básico.

## 📁 Estrutura do Projeto

```
habit-tracker/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php      # Controla login/logout
│   │   │   │   └── RegisterController.php   # Controla registro de usuários
│   │   │   └── Site/
│   │   │       ├── Habit/
│   │   │       │   └── HabitController.php  # CRUD de hábitos
│   │   │       └── SiteController.php       # Página inicial
│   │   └── Requests/
│   │       ├── HabitRequest.php             # Validação de hábitos
│   │       ├── LoginRequest.php             # Validação de login
│   │       └── RegisterRequest.php          # Validação de registro
│   └── Models/
│       ├── User.php                         # Model de usuário
│       ├── Habit.php                        # Model de hábito
│       └── HabitLog.php                     # Model de log de hábito
├── bootstrap/
│   └── app.php                              # Configuração da aplicação
├── config/                                  # Arquivos de configuração
├── database/
│   ├── migrations/                          # Migrations do banco
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2026_02_20_130752_create_habits_table.php
│   │   └── 2026_02_20_131420_create_habit_logs_table.php
│   ├── seeders/                             # Seeders para dados de teste
│   │   ├── DatabaseSeeder.php
│   │   ├── UserSeeder.php
│   │   ├── HabitSeeder.php
│   │   └── HabitLogSeeder.php
│   └── factories/                           # Factories para testes
├── public/                                  # Arquivos públicos
├── resources/
│   ├── views/                               # Views Blade
│   │   ├── auth/                            # Views de autenticação
│   │   ├── site/                            # Views do site
│   │   │   ├── habit/                       # Views de hábitos
│   │   │   │   ├── index.blade.php          # Dashboard/Lista de hábitos
│   │   │   │   ├── create.blade.php         # Criar hábito
│   │   │   │   └── edit.blade.php            # Editar hábito
│   │   │   └── index.blade.php              # Página inicial
│   │   └── components/                      # Componentes Blade
│   │       ├── layout.blade.php             # Layout principal
│   │       ├── header.blade.php             # Cabeçalho
│   │       └── footer.blade.php             # Rodapé
│   ├── css/
│   │   └── app.css                          # Estilos principais
│   └── js/
│       └── app.js                           # JavaScript principal
├── routes/
│   └── web.php                              # Rotas da aplicação
├── storage/                                 # Arquivos de armazenamento
├── tests/                                   # Testes automatizados
├── vendor/                                  # Dependências Composer
├── composer.json                            # Dependências PHP
├── package.json                             # Dependências Node
├── vite.config.js                           # Configuração do Vite
└── phpunit.xml                              # Configuração do PHPUnit
```

### Relacionamentos entre Models

- **User** `hasMany` **Habit** - Um usuário pode ter muitos hábitos
- **User** `hasMany` **HabitLog** - Um usuário pode ter muitos logs
- **Habit** `belongsTo` **User** - Um hábito pertence a um usuário
- **Habit** `hasMany` **HabitLog** - Um hábito pode ter muitos logs
- **HabitLog** `belongsTo` **User** - Um log pertence a um usuário
- **HabitLog** `belongsTo` **Habit** - Um log pertence a um hábito

## 🎮 Comandos Úteis

### Desenvolvimento

Inicia o servidor, fila, logs e Vite simultaneamente:

```bash
composer run dev
```

Este comando inicia:
- Servidor Laravel (`php artisan serve`)
- Worker de fila (`php artisan queue:listen`)
- Laravel Pail para logs (`php artisan pail`)
- Vite para hot-reload (`npm run dev`)

### Testes

Executar todos os testes:

```bash
composer run test
```

Ou usando o Artisan diretamente:

```bash
php artisan test
```

Executar testes específicos:

```bash
php artisan test --filter=NomeDoTeste
```

### Formatação de Código

Formatar código com Laravel Pint:

```bash
vendor/bin/pint
```

Formatar apenas arquivos modificados:

```bash
vendor/bin/pint --dirty
```

### Migrations

Criar nova migration:

```bash
php artisan make:migration nome_da_migration
```

Executar migrations:

```bash
php artisan migrate
```

Reverter última migration:

```bash
php artisan migrate:rollback
```

Reverter todas as migrations:

```bash
php artisan migrate:reset
```

### Seeders

Executar seeders:

```bash
php artisan db:seed
```

Executar seeder específico:

```bash
php artisan db:seed --class=UserSeeder
```

### Assets

Desenvolvimento (com hot-reload):

```bash
npm run dev
```

Produção (build otimizado):

```bash
npm run build
```

### Outros Comandos Úteis

Limpar cache:

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

Listar rotas:

```bash
php artisan route:list
```

Abrir Tinker (console interativo):

```bash
php artisan tinker
```

## 📖 Uso da Aplicação

### Fluxo de Autenticação

1. **Registro de Usuário**
   - Acesse `/create-user`
   - Preencha nome, email e senha
   - Após o registro, você será autenticado automaticamente

2. **Login**
   - Acesse `/login`
   - Informe email e senha
   - Opção de "Lembrar de mim" disponível

3. **Logout**
   - Clique no botão "Sair" no cabeçalho
   - Você será redirecionado para a página de login

### Gerenciamento de Hábitos

1. **Criar Hábito**
   - Após fazer login, você será redirecionado para `/habits` (dashboard)
   - Clique no botão "Cadastrar novo hábito"
   - Preencha o nome do hábito
   - Clique em "Cadastrar"

2. **Visualizar Hábitos**
   - No dashboard (`/habits`), todos os seus hábitos são listados
   - Cada hábito mostra:
     - Nome do hábito
     - Quantidade de vezes que foi completado
     - Botões de ação (check, editar, remover)

3. **Editar Hábito**
   - Clique no ícone de lápis ao lado do hábito
   - Modifique o nome
   - Clique em "Atualizar"

4. **Remover Hábito**
   - Clique no ícone de lixeira ao lado do hábito
   - Confirme a remoção
   - O hábito e todos os seus logs serão removidos

5. **Marcar Hábito como Completo**
   - Clique no botão de check (✓) ao lado do hábito
   - O hábito será marcado como completado para o dia atual
   - O contador de vezes será atualizado

### Navegação

A barra de navegação no dashboard oferece acesso a:
- **Hoje**: Visualizar hábitos do dia atual (em desenvolvimento)
- **Histórico**: Ver histórico de atividades (em desenvolvimento)
- **Calendário**: Visualização em calendário (em desenvolvimento)
- **Gerenciar Hábitos**: Acesso ao CRUD de hábitos

## 🗄️ Estrutura do Banco de Dados

### Tabela: `users`

Armazena informações dos usuários.

| Coluna | Tipo | Descrição |
|--------|------|-----------|
| id | bigint | Chave primária |
| name | string | Nome do usuário |
| email | string | Email (único) |
| email_verified_at | timestamp | Data de verificação do email |
| password | string | Senha (hash) |
| created_at | timestamp | Data de criação |
| updated_at | timestamp | Data de atualização |

### Tabela: `habits`

Armazena os hábitos dos usuários.

| Coluna | Tipo | Descrição |
|--------|------|-----------|
| id | bigint | Chave primária |
| user_id | bigint | Foreign key para users |
| name | string | Nome do hábito (único) |
| created_at | timestamp | Data de criação |
| updated_at | timestamp | Data de atualização |

**Relacionamentos:**
- `user_id` → `users.id` (CASCADE DELETE)

### Tabela: `habit_logs`

Armazena os registros de quando hábitos foram completados.

| Coluna | Tipo | Descrição |
|--------|------|-----------|
| id | bigint | Chave primária |
| user_id | bigint | Foreign key para users |
| habit_id | bigint | Foreign key para habits |
| completed_at | date | Data em que foi completado |
| created_at | timestamp | Data de criação |
| updated_at | timestamp | Data de atualização |

**Relacionamentos:**
- `user_id` → `users.id` (CASCADE DELETE)
- `habit_id` → `habits.id` (CASCADE DELETE)
- Índice único: `(habit_id, completed_at)` - Evita duplicatas no mesmo dia

### Diagrama de Relacionamentos

```
┌─────────┐
│  User   │
└────┬────┘
     │
     │ hasMany
     │
     ├─────────────────┐
     │                 │
     ▼                 ▼
┌─────────┐      ┌───────────┐
│ Habit   │      │ HabitLog  │
└────┬────┘      └─────┬─────┘
     │                 │
     │ hasMany         │ belongsTo
     │                 │
     └────────┬────────┘
              │
              │ belongsTo
              │
         ┌────┴────┐
         │  Habit  │
         └─────────┘
```

## 🛠️ Desenvolvimento

### Scripts Disponíveis

Definidos em `composer.json`:

- `composer run setup` - Instalação completa do projeto
- `composer run dev` - Ambiente de desenvolvimento completo
- `composer run test` - Executar testes

### Ferramentas de Desenvolvimento

**Laravel Boost**
- Ferramentas MCP para desenvolvimento Laravel
- Acesso a documentação versionada
- Comandos Artisan facilitados

**Laravel Pail**
- Visualização de logs em tempo real
- Filtros e busca avançada
- Integrado no comando `composer run dev`

**Laravel Pint**
- Formatador de código automático
- Baseado no PHP-CS-Fixer
- Configuração padrão do Laravel

**Pest PHP**
- Framework de testes moderno
- Sintaxe limpa e expressiva
- Integração nativa com Laravel

### Convenções de Código

- **PSR-12** para formatação de código PHP
- **Nomes descritivos** para variáveis e métodos
- **Type hints** obrigatórios em métodos
- **PHPDoc** para documentação
- **Form Requests** para validação (não validação inline)
- **Resource Routes** para CRUD completo
- **Eloquent Relationships** ao invés de queries manuais

### Estrutura de Rotas

O projeto usa **Resource Routes** do Laravel para hábitos:

```php
Route::resource('habits', HabitController::class);
```

Isso gera automaticamente:
- `GET /habits` → `habits.index` (Dashboard)
- `GET /habits/create` → `habits.create` (Formulário de criação)
- `POST /habits` → `habits.store` (Salvar novo hábito)
- `GET /habits/{habit}/edit` → `habits.edit` (Formulário de edição)
- `PUT/PATCH /habits/{habit}` → `habits.update` (Atualizar hábito)
- `DELETE /habits/{habit}` → `habits.destroy` (Remover hábito)
- `GET /habits/{habit}` → `habits.show` (Visualizar hábito - não implementado)

## 🚢 Deploy e Commit

### Checklist Antes do Commit

- [ ] Código formatado com `vendor/bin/pint`
- [ ] Testes passando (`composer run test`)
- [ ] Assets compilados para produção (`npm run build`)
- [ ] Migrations criadas (se houver mudanças no banco)
- [ ] Variáveis de ambiente documentadas (se novas)
- [ ] README atualizado (se necessário)

### Comandos para Preparar para Produção

1. **Formatar código:**
```bash
vendor/bin/pint
```

2. **Executar testes:**
```bash
composer run test
```

3. **Compilar assets:**
```bash
npm run build
```

4. **Otimizar autoload:**
```bash
composer install --optimize-autoloader --no-dev
```

5. **Cache de configuração:**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Variáveis de Ambiente para Produção

Certifique-se de ajustar no `.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seu-dominio.com
```

### Build de Assets para Produção

```bash
npm run build
```

Isso cria uma versão otimizada e minificada dos assets em `public/build/`.

## 📝 Notas Adicionais

### Segurança

- Senhas são automaticamente hasheadas pelo Laravel
- Rotas protegidas com middleware `auth`
- Validação de propriedade de recursos (usuário só pode editar seus próprios hábitos)
- Proteção CSRF em todos os formulários
- Validação de dados com Form Requests

### Performance

- Eager loading usado para evitar N+1 queries
- Assets compilados e otimizados para produção
- Cache de configuração em produção

### Extensões Futuras

A estrutura atual permite fácil extensão para:
- Visualização de histórico detalhado
- Calendário de atividades
- Estatísticas e gráficos
- Metas e objetivos
- Notificações e lembretes

## 📄 Licença

Este projeto está sob a licença MIT.

## 🤝 Contribuindo

Contribuições são bem-vindas! Por favor:

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📧 Suporte

Para questões e suporte, abra uma issue no repositório do projeto.

---

**Desenvolvido com ❤️ usando Laravel 12**
