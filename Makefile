#run container
init: docker-down-clear docker-pull docker-build-pull docker-up

#install framework, if a project is a new one
framework:laravel-install

#install composer packages
composer:composer-install composer-install-packages

#shut down container
down: docker-down-clear

#migrations
migrate: laravel-migrate
migrate-fresh: laravel-migrate-fresh
migrate-fresh-seed: laravel-migrate-fresh-seed

current_dir := $(abspath $(patsubst %/,%,$(dir $(abspath $(lastword $(MAKEFILE_LIST))))))

docker-up:
	docker-compose up -d

docker-down-clear:
	#docker-compose down
	docker-compose down -v --remove-orphans


docker-pull:
	docker-compose pull

docker-build-pull:
	docker-compose build --pull

laravel-install:
	docker-compose exec app composer create-project laravel/laravel application

composer-install:
	docker run --rm -v $(current_dir):/app composer install

composer-install-packages:
	docker-compose exec app sh -c "composer require barryvdh/laravel-debugbar --dev && composer require --dev barryvdh/laravel-ide-helper"

laravel-migrate:
	docker-compose exec app sh -c "php artisan migrate"

laravel-migrate-fresh:
	docker-compose exec app sh -c "php artisan migrate:fresh"

laravel-migrate-fresh-seed:
	docker-compose exec app sh -c "php artisan migrate:fresh --seed"

run-workers:
	docker-compose exec app sh -c "php artisan queue:work --queue=user:events:0 &&\
	 php artisan queue:work --queue=user:events:1 &&\
	 php artisan queue:work --queue=user:events:2 &&\
	 php artisan queue:work --queue=user:events:3 &&\
	 php artisan queue:work --queue=user:events:4";
