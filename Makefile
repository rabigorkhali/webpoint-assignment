setup:
	@make build
	@make up 
	@make composer-install
	@make migrate
	@make data
	@make initial-commands

build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
exec:
	docker exec -it webpoint-assignment-rabigorkhali-container bash

composer-install:
	docker exec webpoint-assignment-rabigorkhali-container bash -c "composer install"

migrate:
	docker exec webpoint-assignment-rabigorkhali-container bash -c "php artisan migrate --force"

initial-commands:	
	docker exec webpoint-assignment-rabigorkhali-container bash -c "npm install"
	docker exec webpoint-assignment-rabigorkhali-container bash -c "npm run dev"

data:	
	docker exec webpoint-assignment-rabigorkhali-container bash -c "php artisan db:seed --force"