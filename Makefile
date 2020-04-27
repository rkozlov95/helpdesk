setup:
	cp -n .env.example .env
	npm install
	composer install
	php artisan key:generate
run:
	php artisan serve
lint:
	composer run phpcs
