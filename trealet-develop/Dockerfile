FROM composer:2.0 as build
COPY . /app/

RUN docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install pdo pdo_mysql

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM php:8.1-apache-buster as production

ENV APP_ENV=local
ENV APP_DEBUG=true

RUN docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install pdo pdo_mysql
COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

COPY --from=build /app /var/www/html
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY --chown=www:www . /var/www/html/


COPY --chown=www:www . /var/www/html/public/upload/

COPY .env.prod /var/www/html/.env

RUN chmod -R 777 /var/www/html

RUN chmod -R 777 /var/www/html/public/upload/

RUN php artisan config:cache && \
    chmod 777 -R /var/www/html/storage/ && \
    chmod 777 -R  /var/www/html/public/upload/ && \
    chown 777 -R www-data:www-data /var/www/ && \
    a2enmod rewrite