FROM php:7.2-fpm

RUN groupadd --gid 1000 laravel && useradd --gid laravel --shell /bin/sh laravel

RUN mkdir -p /var/www/html

ADD ./src/ /var/www/html

RUN chmod -R 777 /var/www/html/storage
RUN chmod -R 777 /var/www/html/bootstrap/cache

RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 9000

USER laravel