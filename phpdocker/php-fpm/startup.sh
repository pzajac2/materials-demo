#!/bin/bash

cd /application
if [ -e composer.json ]; then
  composer install
else
  echo "No composer.json"
fi

/usr/sbin/php-fpm7.3 -O