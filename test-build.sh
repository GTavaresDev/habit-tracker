#!/bin/bash

# Script para testar o build de produção localmente
# Simula o processo de build do Railway

set -e

echo "🔍 Verificando versão do Node.js..."
node_version=$(node -v | cut -d'v' -f2 | cut -d'.' -f1)
if [ "$node_version" -lt 20 ]; then
    echo "❌ Erro: Node.js 20+ é necessário. Versão atual: $(node -v)"
    echo "💡 Use nvm para instalar Node.js 20: nvm install 20 && nvm use 20"
    exit 1
fi
echo "✅ Node.js $(node -v) - OK"

echo ""
echo "📦 Instalando dependências do Composer..."
composer install --ignore-platform-reqs

echo ""
echo "📦 Instalando dependências do npm..."
npm ci

echo ""
echo "🔨 Executando build de produção..."
echo "  - Composer (sem dev)..."
composer install --no-dev --optimize-autoloader

echo "  - NPM build..."
npm run build

echo ""
echo "💾 Criando caches do Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""
echo "✅ Build concluído com sucesso!"
echo "📁 Assets compilados em: public/build/"
