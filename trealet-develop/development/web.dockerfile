FROM nginx:1.21

WORKDIR /var/www/html

COPY . /var/www/html/

COPY .env.prod /var/www/html/.env

COPY ./development/vhost.conf /etc/nginx/conf.d/default.conf

RUN chmod -R 0755 /var/www/html/public/upload

RUN ln -sf /dev/stdout /var/log/nginx/access.log \
	&& ln -sf /dev/stderr /var/log/nginx/error.log
