FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql intl zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
