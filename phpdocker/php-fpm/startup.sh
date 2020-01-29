#!/bin/bash

cd /application
if [ -e composer.json ]; then
  composer install
else
  echo "No composer.json"
fi

chmod -R 777 /application/data

php public/index.php migrations:migrate -n

/usr/sbin/php-fpm7.3 -O