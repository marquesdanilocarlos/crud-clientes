#!/bin/bash

cd api/;
cp .env.example .env;
cd ../client;
cp .env.example .env;

docker-compose up -d;
docker-compose exec -w /var/www/html api composer install;
docker-compose exec api php /var/www/html/artisan migrate --seed;
docker-compose exec client npm i;
docker-compose exec client npm run build;
docker-compose exec client http-server -p 8081 --proxy http://localhost:8081?;

