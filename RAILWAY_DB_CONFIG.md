# 🔧 Configuração do Banco de Dados no Railway

## Variáveis Fornecidas pelo Railway

Quando você cria um banco MySQL no Railway, ele fornece estas variáveis:

```env
MYSQL_DATABASE="railway"
MYSQL_ROOT_PASSWORD="GqTUqcJjIaxayoKSHtpsurNcOGshndaT"
MYSQLDATABASE="${{MYSQL_DATABASE}}"
MYSQLHOST="${{RAILWAY_PRIVATE_DOMAIN}}"
MYSQLPASSWORD="${{MYSQL_ROOT_PASSWORD}}"
MYSQLPORT="3306"
MYSQLUSER="root"
```

## ✅ Variáveis que o Laravel Precisa

No Railway, vá em **Variables** do seu serviço web e adicione/configure:

```env
# Banco de Dados MySQL
DB_CONNECTION=mysql
DB_HOST=${{MYSQLHOST}}
DB_PORT=${{MYSQLPORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}
```

## 📝 Passo a Passo

1. **No Railway, vá no seu serviço web (não no banco de dados)**
2. **Clique em "Variables"**
3. **Adicione estas variáveis:**

   | Nome | Valor |
   |------|-------|
   | `DB_CONNECTION` | `mysql` |
   | `DB_HOST` | `${{MYSQLHOST}}` |
   | `DB_PORT` | `${{MYSQLPORT}}` |
   | `DB_DATABASE` | `${{MYSQLDATABASE}}` |
   | `DB_USERNAME` | `${{MYSQLUSER}}` |
   | `DB_PASSWORD` | `${{MYSQLPASSWORD}}` |

4. **Salve as variáveis**

## ⚠️ IMPORTANTE

- Use a sintaxe `${{VARIAVEL}}` para referenciar as variáveis do Railway
- Não use valores hardcoded como `"127.0.0.1"` ou `"root"`
- O Railway injeta automaticamente essas variáveis quando você conecta o banco ao serviço

## 🔍 Verificação

Após configurar, verifique nos logs do deploy se:
- ✅ As migrations executam sem erro
- ✅ Não há erros de conexão com banco de dados
- ✅ O servidor inicia corretamente

## 🐛 Problemas Comuns

### Erro: "SQLSTATE[HY000] [2002] Connection refused"

**Solução:** Verifique se:
- O serviço de banco está rodando
- As variáveis `DB_*` estão configuradas corretamente
- Você está usando `${{MYSQLHOST}}` e não valores hardcoded

### Erro: "Access denied for user"

**Solução:** Verifique se:
- `DB_USERNAME` está como `${{MYSQLUSER}}`
- `DB_PASSWORD` está como `${{MYSQLPASSWORD}}`
- Não está usando valores hardcoded

### Erro: "Unknown database"

**Solução:** Verifique se:
- `DB_DATABASE` está como `${{MYSQLDATABASE}}`
- O banco foi criado corretamente no Railway
