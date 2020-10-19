## Passos para executar a aplicação

```bash

No diretório "api" executar os seguintes passos:
Copiar o arquivo .env.example para .env

No diretório "client" executar os seguintes passos:
Copiar o arquivo .env.example para .env

No diretório raiz executar o script start.sh com o comando:
./start.sh

Ou executar os comandos em separado:
docker-compose up -d
docker-compose exec -w /var/www/html api composer install
docker-compose exec api php /var/www/html/artisan migrate --seed
docker-compose exec client npm i
docker-compose exec client npm run build
docker-compose exec client http-server -p 8081 --proxy http://localhost:8081?


A aplicação estará acessível no endereço http://127.0.0.1:8081
