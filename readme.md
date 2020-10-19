## Passos para executar a aplicação

```bash

No diretório "api" executar os seguintes passos:
Copiar o arquivo .env.example para .env

No diretório "client" executar os seguintes passos:
Copiar o arquivo .env.example para .env

No diretório raiz executar os seguintes comandos:
docker-compose up -d
docker-compose exec -w /var/www/html api composer install
docker-compose exec api php /var/www/html/artisan migrate --seed
docker-compose exec client http-server --port 8081 --proxy http://localhost:8081?
