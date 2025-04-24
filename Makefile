.PHONY: build
build:
	docker-compose build

.PHONY: up
up:
	docker-compose up -d
	docker-compose exec php-fpm composer install
	docker-compose exec php-fpm npm install
	docker-compose exec php-fpm sh -c chown -R www-data:www-data /var/www/storage 
	docker-compose exec php-fpm sh -c chmod -R 775 /var/www/storage
	docker-compose exec php-fpm php artisan l5-swagger:generate

.PHONY: stop
stop:
	docker-compose stop

.PHONY: rm
rm:
	docker-compose rm

.DEFAULT_GOAL := build