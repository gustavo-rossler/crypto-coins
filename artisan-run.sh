#!/bin/sh

php artisan migrate
php artisan db:seed
php artisan serve --host 0.0.0.0
