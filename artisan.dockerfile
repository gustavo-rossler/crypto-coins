FROM php:7.2-fpm

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

COPY ./src .

COPY ./artisan-run.sh /artisan-run.sh

RUN chmod +x /artisan-run.sh

ENTRYPOINT ["/artisan-run.sh"]

EXPOSE 8000
