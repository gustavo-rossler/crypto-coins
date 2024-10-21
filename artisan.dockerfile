FROM php:7.2-fpm

RUN groupadd --gid 1000 laravel && useradd --gid laravel --shell /bin/sh laravel

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

COPY ./src .

COPY ./artisan-run.sh /artisan-run.sh

RUN chmod +x /artisan-run.sh

ENTRYPOINT ["/artisan-run.sh"]

EXPOSE 8000

USER laravel