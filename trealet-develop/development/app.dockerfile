FROM php:8.1.7-fpm as dev

RUN apt-get update && apt-get install -y  \
    libmagickwand-dev \
    --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install pdo_mysql pdo

# ----------------------
# Composer install step
# ----------------------
FROM composer:2 as build

WORKDIR /app

COPY composer.lock composer.json ./

COPY database/ database/

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# ----------------------
# The FPM production container
# ----------------------
FROM dev

WORKDIR /var/www/html

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY --chown=www:www . /var/www/html

# USER www

COPY .env.prod .env

COPY --from=build /app/vendor/ /var/www/html/vendor/
# COPY --from=node /app/public/js/ /app/public/js/
# COPY --from=node /app/public/css/ /app/public/css/
# COPY --from=node /app/mix-manifest.json /app/public/mix-manifest.json

# COPY ./public/js/ /var/www/public/js/
# COPY ./public/assets/css/ /var/www/public/assets/css/
# COPY  ./public/mix-manifest.json /var/www/public/mix-manifest.json


RUN chown -R www-data:www-data /var/www/html/public/upload/trealet-data/

RUN chmod -R 777 /var/www/html/storage/

RUN chmod -R 777 /var/www/html/public/upload/trealet-data/

RUN php artisan key:generate
RUN php artisan config:clear
RUN php artisan cache:clear

EXPOSE 9000