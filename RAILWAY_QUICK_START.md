# 🚂 Railway - Início Rápido

## ⚡ Deploy em 5 Minutos

### 1. Criar Projeto no Railway
- Acesse https://railway.app
- Login com GitHub
- "New Project" → "Deploy from GitHub repo"
- Selecione seu repositório

### 2. Adicionar Banco de Dados
- No projeto: "+ New" → "Database" → "MySQL" ou "PostgreSQL"

### 3. Configurar Variáveis de Ambiente

No serviço web, adicione em "Variables":

```env
APP_KEY=base64:GERAR_COM_php_artisan_key_generate_--show
APP_ENV=production
APP_DEBUG=false
APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}

# Banco (Railway injeta automaticamente - mapear para Laravel)
DB_CONNECTION=mysql
DB_HOST=${{MYSQL_HOST}}
DB_PORT=${{MYSQL_PORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}

# Sessões
SESSION_DRIVER=database
```

### 4. Build e Start Commands

**Build Command:**
```bash
composer install --no-dev --optimize-autoloader && npm install && npm run build
```

**Start Command:**
```bash
php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

### 5. Gerar Domínio
- Settings → "Generate Domain"

### 6. Deploy
- Railway faz deploy automático ao fazer push no Git
- Ou clique em "Deploy" no dashboard

---

## ✅ Pronto!

Acesse o domínio gerado e teste a aplicação.

**📖 Guia completo:** Veja `DEPLOY_RAILWAY.md` para detalhes e troubleshooting.
