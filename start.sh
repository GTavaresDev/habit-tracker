#!/bin/bash

# Script de inicialização robusto para Railway
set -e

echo "🚀 Iniciando aplicação Laravel..."

# Verificar se APP_KEY está configurada
if [ -z "$APP_KEY" ]; then
    echo "❌ ERRO: APP_KEY não está configurada!"
    echo "   Configure APP_KEY nas variáveis de ambiente do Railway"
    exit 1
fi

# Verificar se as variáveis do banco estão configuradas
if [ -z "$DB_HOST" ] || [ -z "$DB_DATABASE" ]; then
    echo "⚠️  AVISO: Variáveis do banco podem não estar configuradas corretamente"
fi

# Executar migrations
echo "📦 Executando migrations..."
php artisan migrate --force || {
    echo "⚠️  Aviso: Migrations falharam, mas continuando..."
}

# Verificar se a porta está definida
if [ -z "$PORT" ]; then
    echo "❌ ERRO: Variável PORT não está definida!"
    exit 1
fi

# Iniciar servidor
echo "🌐 Iniciando servidor na porta $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
