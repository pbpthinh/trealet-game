FROM nginx:1.19-alpine

WORKDIR /app/public

COPY ./docker/nginx.conf /etc/nginx/nginx.conf
COPY ./public/* /app/public/
COPY ./docker/resolve-localdomain.sh /docker-entrypoint.d/30-resolve-localdomain.sh

# RUN chown -R www-data:www-data /var/www
RUN chown -R www-data:www-data /app/public
RUN chmod -R 777 /app/public/upload/trealet-data/

RUN chmod +x /docker-entrypoint.d/30-resolve-localdomain.sh
