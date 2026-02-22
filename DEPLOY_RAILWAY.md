# 🚂 Guia de Deploy no Railway

Railway é uma plataforma excelente para deploy de aplicações Laravel. Ela oferece deploy automático, banco de dados incluído, SSL automático e é muito fácil de usar.

## 📋 Pré-requisitos

1. Conta no Railway (https://railway.app) - Pode usar GitHub para login
2. Repositório Git no GitHub/GitLab/Bitbucket
3. Conta no GitHub (recomendado)

---

## 🚀 Deploy Passo a Passo

### Passo 1: Criar Conta no Railway

1. Acesse https://railway.app
2. Clique em "Login" e faça login com sua conta GitHub
3. Aceite as permissões necessárias

### Passo 2: Criar Novo Projeto

1. No dashboard do Railway, clique em **"New Project"**
2. Selecione **"Deploy from GitHub repo"**
3. Escolha o repositório do seu projeto `habit-tracker`
4. O Railway irá detectar automaticamente que é um projeto Laravel

### Passo 3: Adicionar Banco de Dados

1. No projeto criado, clique em **"+ New"**
2. Selecione **"Database"**
3. Escolha **"MySQL"** ou **"PostgreSQL"** (recomendo PostgreSQL)
4. O Railway criará automaticamente um banco de dados

### Passo 4: Configurar Variáveis de Ambiente

O Railway detecta automaticamente as variáveis do banco de dados e as disponibiliza. Você precisa adicionar as outras:

1. No seu serviço (web service), clique em **"Variables"**
2. Adicione as seguintes variáveis:

```env
APP_NAME="Habit Tracker"
APP_ENV=production
APP_DEBUG=false
APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}

# Banco de Dados (Railway injeta automaticamente, mas você pode sobrescrever)
DB_CONNECTION=mysql
# ou para PostgreSQL:
# DB_CONNECTION=pgsql

# Sessões
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Logs
LOG_CHANNEL=stderr
LOG_LEVEL=error
```

**⚠️ IMPORTANTE:** O Railway injeta automaticamente as variáveis do banco de dados com os seguintes nomes:
- `MYSQL_HOST` ou `PGHOST`
- `MYSQL_PORT` ou `PGPORT`
- `MYSQLDATABASE` ou `PGDATABASE`
- `MYSQLUSER` ou `PGUSER`
- `MYSQLPASSWORD` ou `PGPASSWORD`

Você precisa mapear essas variáveis para o formato que o Laravel espera. Adicione estas variáveis também:

```env
# Para MySQL
DB_HOST=${{MYSQL_HOST}}
DB_PORT=${{MYSQL_PORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}

# OU para PostgreSQL
DB_HOST=${{PGHOST}}
DB_PORT=${{PGPORT}}
DB_DATABASE=${{PGDATABASE}}
DB_USERNAME=${{PGUSER}}
DB_PASSWORD=${{PGPASSWORD}}
```

### Passo 5: Gerar APP_KEY

1. No terminal local, execute:
```bash
php artisan key:generate --show
```

2. Copie a chave gerada e adicione como variável de ambiente no Railway:
```env
APP_KEY=base64:SUA_CHAVE_AQUI
```

### Passo 6: Configurar Build e Start Commands

O Railway geralmente detecta Laravel automaticamente, mas você pode configurar manualmente:

1. No seu serviço, vá em **"Settings"**
2. Configure:

**Build Command:**
```bash
composer install --no-dev --optimize-autoloader && npm install && npm run build
```

**Start Command:**
```bash
php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=$PORT
```

**Ou use o comando mais simples (recomendado):**
```bash
php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

### Passo 7: Configurar Domínio Público

1. No seu serviço, vá em **"Settings"**
2. Ative **"Generate Domain"** para obter um domínio público
3. Ou configure um domínio customizado em **"Custom Domain"**

### Passo 8: Deploy

O Railway faz deploy automático sempre que você faz push para o repositório. Para fazer o primeiro deploy:

1. Certifique-se de que todas as variáveis estão configuradas
2. O Railway iniciará o build automaticamente
3. Aguarde o deploy completar (geralmente 2-5 minutos)

### Passo 9: Verificar Deploy

1. Após o deploy, acesse o domínio gerado
2. Verifique se a aplicação está funcionando
3. Teste o login e criação de hábitos

---

## 🔧 Configuração Avançada

### Usar arquivo `railway.json` (Opcional)

Você pode criar um arquivo `railway.json` na raiz do projeto para configurar o build:

```json
{
  "$schema": "https://railway.app/railway.schema.json",
  "build": {
    "builder": "NIXPACKS",
    "buildCommand": "composer install --no-dev --optimize-autoloader && npm install && npm run build"
  },
  "deploy": {
    "startCommand": "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT",
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 10
  }
}
```

### Configurar Storage

O Railway tem sistema de arquivos persistente, mas para produção é recomendado usar S3 ou similar. Para desenvolvimento, você pode usar o storage local:

```env
FILESYSTEM_DISK=local
```

### Configurar Sessões

O projeto já está configurado para usar sessões em banco de dados por padrão. A tabela `sessions` é criada automaticamente pela migration `create_users_table.php`.

Apenas configure no Railway:
```env
SESSION_DRIVER=database
```

---

## 🐛 Problemas Comuns e Soluções

### 1. Erro: "APP_KEY not set"

**Solução:** Gere a chave e adicione como variável de ambiente:
```bash
php artisan key:generate --show
```

### 2. Erro: "Database connection failed"

**Solução:** Verifique se as variáveis do banco estão mapeadas corretamente. Use as variáveis injetadas pelo Railway:
```env
DB_HOST=${{MYSQL_HOST}}
DB_DATABASE=${{MYSQLDATABASE}}
# etc...
```

### 3. Erro: "Storage not writable"

**Solução:** O Railway tem sistema de arquivos persistente, mas certifique-se de que o diretório `storage` tem permissões corretas. Adicione no build command:
```bash
chmod -R 775 storage bootstrap/cache
```

### 4. Assets não carregam

**Solução:** Certifique-se de que `npm run build` está sendo executado no build command.

### 5. Erro: "Port already in use"

**Solução:** Use a variável `$PORT` no comando start:
```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

### 6. Migrations não executam

**Solução:** Adicione `php artisan migrate --force` no start command.

---

## 📝 Checklist de Deploy

- [ ] Conta no Railway criada
- [ ] Projeto criado e conectado ao repositório
- [ ] Banco de dados adicionado (MySQL ou PostgreSQL)
- [ ] Variáveis de ambiente configuradas
- [ ] `APP_KEY` gerada e configurada
- [ ] Variáveis do banco mapeadas corretamente
- [ ] Build command configurado
- [ ] Start command configurado
- [ ] Domínio público gerado
- [ ] Deploy realizado com sucesso
- [ ] Migrations executadas
- [ ] Aplicação testada

---

## 🎯 Comandos Úteis

### Ver logs em tempo real
No dashboard do Railway, clique em "View Logs" para ver os logs em tempo real.

### Executar comandos Artisan
No dashboard, vá em "Deployments" > "View Logs" e você pode executar comandos via terminal.

### Reiniciar o serviço
No dashboard, clique em "Restart" no seu serviço.

### Ver variáveis de ambiente
No dashboard, vá em "Variables" para ver e editar todas as variáveis.

---

## 💰 Custos

Railway oferece:
- **Plano Hobby (Gratuito):** $5 de crédito grátis por mês
- **Plano Pro:** $20/mês com mais recursos

Para projetos pequenos/médios, o plano gratuito geralmente é suficiente.

---

## 📚 Recursos Adicionais

- [Documentação Railway](https://docs.railway.app)
- [Guia Laravel no Railway](https://docs.railway.app/guides/laravel)
- [Railway Discord](https://discord.gg/railway) - Comunidade ativa para suporte

---

## 🎉 Pronto!

Seu projeto Laravel está deployado no Railway! O Railway faz deploy automático sempre que você faz push para o repositório, então você só precisa fazer commit e push para atualizar a aplicação.

**Dica:** Configure um webhook do GitHub para notificações de deploy, ou use o dashboard do Railway para monitorar os deploys.
