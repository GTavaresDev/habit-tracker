# 🔧 Variáveis de Ambiente para Railway

## ⚠️ PROBLEMAS IDENTIFICADOS

Sua configuração atual tem os seguintes problemas:

1. ❌ **APP_KEY está faltando** - Isso causa erro 500!
2. ❌ **DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD** estão com valores locais
3. ❌ **APP_URL** está como "http://localhost" ao invés do domínio do Railway

## ✅ VARIÁVEIS CORRETAS PARA CONFIGURAR

No Railway, vá em **Variables** e configure exatamente assim:

### 1. Primeiro, gere a APP_KEY (OBRIGATÓRIO!)

Execute localmente:
```bash
php artisan key:generate --show
```

Copie a chave gerada (algo como `base64:...`) e adicione no Railway.

### 2. Configure estas variáveis no Railway:

```env
# ⚠️ OBRIGATÓRIO - Gere com: php artisan key:generate --show
APP_KEY=base64:SUA_CHAVE_AQUI

# Aplicação
APP_NAME="Habit Tracker"
APP_ENV=production
APP_DEBUG=false
APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}

# Banco de Dados - USE AS VARIÁVEIS DO RAILWAY!
DB_CONNECTION=mysql
DB_HOST=${{MYSQLHOST}}
DB_PORT=${{MYSQLPORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}

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

### 3. REMOVA ou CORRIJA estas variáveis:

❌ **REMOVA ou CORRIJA:**
- `DB_HOST="127.0.0.1"` → Use `DB_HOST=${{MYSQLHOST}}`
- `DB_DATABASE="habit_tracker"` → Use `DB_DATABASE=${{MYSQLDATABASE}}`
- `DB_USERNAME="root"` → Use `DB_USERNAME=${{MYSQLUSER}}`
- `APP_URL="http://localhost"` → Use `APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}`

### 4. Variáveis opcionais (pode manter como está):

```env
APP_FAKER_LOCALE="en_US"
APP_FALLBACK_LOCALE="en"
APP_LOCALE="en"
APP_MAINTENANCE_DRIVER="file"
AWS_DEFAULT_REGION="us-east-1"
AWS_USE_PATH_STYLE_ENDPOINT="false"
BCRYPT_ROUNDS="12"
BROADCAST_CONNECTION="log"
CACHE_STORE="database"
FILESYSTEM_DISK="local"
LOG_DEPRECATIONS_CHANNEL="null"
LOG_STACK="single"
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
MAIL_HOST="127.0.0.1"
MAIL_MAILER="log"
MAIL_PASSWORD="null"
MAIL_PORT="2525"
MAIL_SCHEME="null"
MAIL_USERNAME="null"
MEMCACHED_HOST="127.0.0.1"
QUEUE_CONNECTION="database"
REDIS_CLIENT="phpredis"
REDIS_HOST="127.0.0.1"
REDIS_PASSWORD="null"
REDIS_PORT="6379"
SESSION_DOMAIN="null"
SESSION_ENCRYPT="false"
SESSION_PATH="/"
VITE_APP_NAME="${APP_NAME}"
```

## 📝 PASSO A PASSO

1. **Gere a APP_KEY:**
   ```bash
   php artisan key:generate --show
   ```

2. **No Railway, vá em Variables e:**
   - Adicione `APP_KEY` com o valor gerado
   - Altere `DB_HOST` para `${{MYSQLHOST}}`
   - Altere `DB_PORT` para `${{MYSQLPORT}}`
   - Altere `DB_DATABASE` para `${{MYSQLDATABASE}}`
   - Altere `DB_USERNAME` para `${{MYSQLUSER}}`
   - Adicione `DB_PASSWORD` com valor `${{MYSQLPASSWORD}}`
   - Altere `APP_URL` para `${{RAILWAY_PUBLIC_DOMAIN}}`
   - Altere `APP_DEBUG` para `false` (ou `true` temporariamente para debug)

3. **Salve e aguarde o redeploy automático**

4. **Teste a aplicação novamente**

## 🔍 Como verificar se está correto

Após configurar, verifique nos logs do Railway se:
- ✅ Não há erros de "APP_KEY not set"
- ✅ Não há erros de conexão com banco de dados
- ✅ O servidor inicia corretamente

## ⚠️ IMPORTANTE

O Railway injeta automaticamente as variáveis do banco de dados quando você adiciona um serviço de banco. Você **DEVE** usar a sintaxe `${{VARIAVEL}}` para referenciá-las, não valores hardcoded!
