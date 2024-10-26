#!/bin/sh

cp -n .env.example .env

php artisan migrate
php artisan db:seed
php artisan serve --host 0.0.0.0
