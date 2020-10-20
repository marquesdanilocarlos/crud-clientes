FROM php:7.2-fpm
WORKDIR /var/www/html

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
COPY . /var/www/html
COPY --chown=www:www . /var/www/html

RUN docker-php-ext-install mbstring tokenizer mysqli pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER www

