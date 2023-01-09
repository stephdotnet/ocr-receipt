start:
	docker-compose up -d

stop:
	docker-compose down

php:
	docker-compose exec web bash

setup:
	docker-compose exec web chmod +x setup.sh && ./setup.sh
