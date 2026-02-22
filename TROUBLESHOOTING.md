# 🔧 Troubleshooting - Railway Deploy

## Como Diagnosticar Problemas

### 1. Verificar os Logs do Railway

1. No dashboard do Railway, clique no seu serviço
2. Vá na aba **"Deployments"**
3. Clique no deployment mais recente
4. Clique em **"View Logs"** ou **"Logs"**
5. Procure por erros em vermelho ou mensagens de falha

### 2. Erros Comuns e Soluções

#### ❌ Erro 500 (Internal Server Error)

**Possíveis causas:**
- `APP_KEY` não configurada
- Banco de dados não conectado
- Storage sem permissões
- Variáveis de ambiente faltando
- Problema com Vite/manifest em produção
- Erro no código PHP

**Solução passo a passo:**

1. **Ative temporariamente o debug para ver o erro:**
   - No Railway, vá em **Variables**
   - Adicione ou altere: `APP_DEBUG=true`
   - Faça redeploy
   - Acesse a URL novamente - você verá o erro detalhado

2. **Verifique os logs do Railway:**
   - No dashboard, clique no serviço
   - Vá em **Deployments** > **View Logs**
   - Procure por mensagens de erro em vermelho
   - Copie a mensagem de erro completa

3. **Verifique variáveis essenciais:**
   ```env
   APP_KEY=base64:SUA_CHAVE_AQUI  # OBRIGATÓRIO!
   APP_ENV=production
   APP_DEBUG=false  # ou true para debug
   APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}
   ```

4. **Verifique se o build do Vite foi executado:**
   - Nos logs do build, procure por "npm run build"
   - Verifique se terminou com sucesso
   - Se falhou, veja a mensagem de erro específica

5. **Verifique permissões de storage:**
   - O build já cria os diretórios, mas se houver erro, execute:
   ```bash
   mkdir -p storage/framework/{sessions,views,cache}
   chmod -R 775 storage bootstrap/cache
   ```

#### ❌ Erro: "No application encryption key has been specified"

**Solução:**
```bash
# Localmente, gere a chave:
php artisan key:generate --show

# Copie a chave e adicione no Railway:
# Variables > APP_KEY = base64:SUA_CHAVE_AQUI
```

#### ❌ Erro: "SQLSTATE[HY000] [2002] Connection refused"

**Solução:**
Verifique se as variáveis do banco estão mapeadas:
```env
DB_HOST=${{MYSQL_HOST}}
DB_PORT=${{MYSQL_PORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}
```

#### ❌ Erro: "The stream or file could not be opened"

**Solução:**
Adicione no build command (ou crie um script de inicialização):
```bash
mkdir -p storage/framework/{sessions,views,cache}
chmod -R 775 storage bootstrap/cache
```

#### ❌ Página em branco ou erro genérico

**Solução:**
1. Ative temporariamente `APP_DEBUG=true` para ver o erro detalhado
2. Verifique os logs do Railway
3. Verifique se todas as migrations foram executadas

### 3. Checklist de Verificação

- [ ] **APP_KEY configurada?**
  - Vá em Variables e verifique se `APP_KEY` existe
  - Se não existir, gere com `php artisan key:generate --show`

- [ ] **Banco de dados conectado?**
  - Verifique se o serviço de banco está rodando
  - Verifique se as variáveis `DB_*` estão configuradas
  - Teste a conexão nos logs

- [ ] **Migrations executadas?**
  - Verifique nos logs se `php artisan migrate --force` foi executado
  - Se não, adicione no start command

- [ ] **Assets compilados?**
  - Verifique se `npm run build` foi executado com sucesso
  - Verifique se a pasta `public/build` existe

- [ ] **Variáveis de ambiente corretas?**
  ```env
  APP_ENV=production
  APP_DEBUG=false
  APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}
  SESSION_DRIVER=database
  ```

### 4. Comandos Úteis para Debug

#### Ver logs em tempo real
No Railway: **Deployments > View Logs**

#### Executar comandos Artisan
No Railway: **Deployments > View Logs > Terminal**

Comandos úteis:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan migrate:status
php artisan tinker
```

#### Verificar variáveis de ambiente
No Railway: **Variables** (aba do serviço)

### 5. Testar Localmente Antes do Deploy

Execute o script de teste:
```bash
./test-build.sh
```

Isso simula o processo de build e ajuda a identificar problemas antes do deploy.

### 6. Reiniciar o Serviço

Se nada funcionar:
1. No Railway, vá no seu serviço
2. Clique em **"Restart"** ou **"Redeploy"**
3. Aguarde o deploy completar

### 7. Contato e Suporte

- **Railway Docs:** https://docs.railway.app
- **Railway Discord:** https://discord.gg/railway
- **Laravel Docs:** https://laravel.com/docs

---

## 🚨 Erro Específico? 

Se você está vendo um erro específico, verifique:

1. **Qual é a mensagem de erro exata?**
   - Copie a mensagem completa dos logs

2. **Em que momento ocorre?**
   - Durante o build?
   - Ao acessar a URL?
   - Ao fazer login?

3. **O que aparece na tela?**
   - Página em branco?
   - Erro 500?
   - Mensagem específica?

Com essas informações, podemos diagnosticar o problema com mais precisão!
