#!/bin/sh

composer config --no-plugins allow-plugins.kylekatarnls/update-helper true
composer config --no-plugins allow-plugins.symfony/thanks true
composer install -vv
