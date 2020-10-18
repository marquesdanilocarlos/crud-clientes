## Passos para executar a aplicação

```bash
No diretório raiz executar os seguintes comandos:
docker-compose up -d
docker-compose exec -w /var/www/html php composer install
docker-compose exec php php /var/www/html/artisan migrate
docker-compose exec php php /var/www/html/artisan jwt:secret

No diretório "api" executar os seguintes comandos:
Copiar o arquivo .env.example para .env

No diretório "client" executar os seguintes comandos:
Copiar o arquivo .env.example para .env
npm install
npm run serve
```
