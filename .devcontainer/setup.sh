#!/bin/bash

cp .env.example .env
composer install
php artisan key:generate
php artisan storage:link
npm install
npm run build