#!/bin/bash

# Script para verificar configuração de deploy
# Execute este script no Railway via terminal para diagnosticar problemas

echo "🔍 Verificando configuração do Laravel..."
echo ""

# Verificar APP_KEY
if [ -z "$APP_KEY" ]; then
    echo "❌ ERRO: APP_KEY não está configurada!"
    echo "   Execute: php artisan key:generate --show"
    echo "   E adicione no Railway: Variables > APP_KEY"
else
    echo "✅ APP_KEY configurada"
fi

# Verificar variáveis do banco
echo ""
echo "📊 Verificando variáveis do banco de dados..."
if [ -z "$DB_HOST" ] || [ -z "$DB_DATABASE" ] || [ -z "$DB_USERNAME" ]; then
    echo "❌ ERRO: Variáveis do banco não configuradas!"
    echo "   Configure no Railway:"
    echo "   DB_HOST=\${{MYSQL_HOST}}"
    echo "   DB_DATABASE=\${{MYSQLDATABASE}}"
    echo "   DB_USERNAME=\${{MYSQLUSER}}"
    echo "   DB_PASSWORD=\${{MYSQLPASSWORD}}"
else
    echo "✅ Variáveis do banco configuradas"
fi

# Verificar storage
echo ""
echo "📁 Verificando storage..."
if [ ! -d "storage/framework" ]; then
    echo "⚠️  Criando diretórios de storage..."
    mkdir -p storage/framework/{sessions,views,cache}
    chmod -R 775 storage bootstrap/cache
else
    echo "✅ Diretórios de storage existem"
fi

# Verificar build do Vite
echo ""
echo "🎨 Verificando build do Vite..."
if [ ! -f "public/build/.vite/manifest.json" ]; then
    echo "⚠️  Manifest do Vite não encontrado!"
    echo "   Execute: npm run build"
else
    echo "✅ Manifest do Vite encontrado"
fi

# Verificar migrations
echo ""
echo "🗄️  Verificando migrations..."
php artisan migrate:status

echo ""
echo "✅ Verificação concluída!"
