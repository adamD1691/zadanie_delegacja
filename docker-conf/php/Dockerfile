FROM php:7.4-fpm

RUN apt-get update && apt-get install -y libonig-dev libzip-dev zlib1g-dev libicu-dev g++ libcurl4-openssl-dev libpng-dev libjpeg-dev libmcrypt-dev less vim libpq-dev libxml2-dev gnumeric
RUN docker-php-ext-install pdo pdo_mysql intl curl gd zip mbstring tokenizer xml bcmath pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer config --global github-oauth.github.com 95b651e1d43110b5fdf050d78b67eed3a5f3aeac
