DOCKER_COMPOSE_CONF=.devcontainer/docker-compose.yml

start:
	docker-compose -f $(DOCKER_COMPOSE_CONF) up -d

stop:
	docker-compose -f $(DOCKER_COMPOSE_CONF) down

php:
	docker-compose -f $(DOCKER_COMPOSE_CONF) exec web bash

setup:
	- make start
	make setExecutable
	docker-compose -f $(DOCKER_COMPOSE_CONF) exec web .devcontainer/setup.sh

setup-codespace: 
	-make setup
	.devcontainer/setup-codespace.sh $(CODESPACE_NAME)

setExecutable:
	chmod +x `ls .devcontainer/*.sh`

pint:
	docker-compose -f $(DOCKER_COMPOSE_CONF) exec web ./vendor/bin/pint

test:
	docker-compose -f $(DOCKER_COMPOSE_CONF) exec web php artisan test