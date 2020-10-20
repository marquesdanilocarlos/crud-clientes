FROM php:7.2-fpm-alpine
WORKDIR /var/www/html

COPY . /var/www/html
COPY --chown=root:root . /var/www/html

RUN docker-php-ext-install mbstring tokenizer mysqli pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER root

