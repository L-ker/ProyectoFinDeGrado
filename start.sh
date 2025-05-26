#!/bin/bash

# Levanta contenedores Docker
echo "Iniciando Docker..."
docker compose up -d

# Inicia servidor PHP
echo "Iniciando servidor PHP..."
php artisan serve &

# Inicia Vite (npm run dev)
echo "Iniciando Vite (npm run dev)..."
npm run dev
