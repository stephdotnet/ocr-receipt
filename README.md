## About this project

This project stands as a kickoff for OCR parsing purpose.

## Installation

### Option 1a : Run in github codespace (auto)

This app is codespace ready (thanks to the .devcontainer/devcontainer.json file). It will automatically setup the codespace and forward the app to the port 80. If it doesn't you still can run the make commande manually (see option 1b)

### Option 1b : Run in github codespace (manual)

- Run `make setup-codespace`

### Option 2 : Run locally

The app is shipped with a `docker-compose` stack so you can run the app this way:

- Run `make setup`
- Run `npm install && npm run dev` or `npm run build`

### Option 3 : Manual setup

If you already have a docker stack, you can run the following commands :

- Copy `.env.example` to `.env`
- Run `php artisan key:generate`
- Run `php artisan storage:link`
- Run `npm install && npm run dev`

## Testing

[![codecov](https://codecov.io/gh/stephdotnet/ocr-receipt/branch/main/graph/badge.svg?token=BQZ9TWVEH8)](https://codecov.io/gh/stephdotnet/ocr-receipt)

- Run test suites with `php artisan test`

## Formatting

Linters and code fixer are available for the php and react codebase.

- Run code fixer on php codebase with `./vendor/bin/pint`
- Run prettier + eslint (code formatting) on resources/src with `npm run prettier`
