start:
	docker-compose up -d

stop:
	docker-compose down

php:
	docker-compose exec -it web bash