#!/bin/bash

cd api/;
cp .env.example .env;
cd ../client;
cp .env.example .env;
cd ../;
#Inicia o ambiente Docker
docker-compose up -d;
#Instala as dependências do composer
docker-compose exec -w /var/www/html api composer install;
#Instala as dependências do NPM
docker-compose exec client npm i;
#Constrói a app frontend
docker-compose exec client npm run build;
#Executa os testes unitários
docker-compose exec -w /var/www/html api ./vendor/bin/phpunit
#Executa as migrations
docker-compose exec api php /var/www/html/artisan migrate --seed;
#Sobe o servidor da app frontend
docker-compose exec client http-server -p 8081 --proxy http://localhost:8081?;
