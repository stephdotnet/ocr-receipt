## About this project

This project stands as a kickoff for OCR parsing purpose.

## Installation

Prerequisite: 
- Docker needs to be installed on your machine

### Option 1a : Run in github codespace (auto)

This app is codespace ready (thanks to the .devcontainer/devcontainer.json file). It will automatically setup the codespace and forward the app to the port 80. If it doesn't you still can run the make commande manually (see option 1b)

### Option 1b : Run in github codespace (manual)

In case the postCreateCommand failed you can still run the setup manually
- Run `./.devcontainer/setup.sh && ./.devcontainer/setup-codespace.sh`

### Option 2a : Run locally via Makefile (linux/mac OS)

The app is shipped with a `docker-compose` stack so you can run the app this way:

- Run `make setup`

### Option 2b : Run locally without Makefile (Windows)

- Run `docker-compose -f .devcontainer/docker-compose.yml up -d` 
- Run `docker-compose -f $(DOCKER_COMPOSE_CONF) exec web .devcontainer/setup.sh` to run the setup

### Post install

- It's suggested to have a look at the `.env` file, in order to check that everything is ok
- Run `npm run dev` to start working

## Testing

[![codecov](https://codecov.io/gh/stephdotnet/ocr-receipt/branch/main/graph/badge.svg?token=BQZ9TWVEH8)](https://codecov.io/gh/stephdotnet/ocr-receipt)

- Run test suites with `php artisan test`

## Formatting

Linters and code fixer are available for the php and react codebase.

- Run code fixer on php codebase with `./vendor/bin/pint`
- Run prettier + eslint (code formatting) on resources/src with `npm run prettier`
