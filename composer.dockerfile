FROM php:7.2-fpm

RUN groupadd --gid 1000 laravel && useradd --gid laravel --shell /bin/sh laravel

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./src .

COPY ./composer-run.sh /composer-run.sh

RUN chmod +x /composer-run.sh

ENTRYPOINT ["/composer-run.sh"]

USER laravel