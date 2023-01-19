#!/bin/bash

scriptPath=$(readlink -f "$0")
scriptDir=$(dirname "$scriptPath")

if ! [ -e "$scriptDir/../.env" ]; then
  cp .env.example .env
else
  echo "File .env already exist"
fi

composer install

if ! tr -d '\r' < .env | sed -n '/^APP_KEY=/s///p' | grep -q . ; then
    php artisan key:generate
else
    echo "APP_KEY has a value assigned (php artisan key:generate ignored)"
fi

php artisan storage:link
npm install
npm run build