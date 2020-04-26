setup:
	cp -n .env.example .env
	npm install
	composer install
run:
	php artisan serve
lint:
	composer run phpcs
