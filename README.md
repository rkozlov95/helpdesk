# helpdesk

[![github action status](https://github.com/rkozlov95/helpdesk/workflows/Master%20workflow/badge.svg)](https://github.com/rkozlov95/helpdesk/actions)

### Requirements

  * PHP ^7.2.5
  * Composer
  * Node.js & npm
  * MySQL for local

Create MySQL database, user, email (or use existing) and register them in .env file.

### Example .env file

```shell
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=users
DB_USERNAME=roman
DB_PASSWORD=your_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_mail
MAIL_PASSWORD=your_password
...

```

### Migrations database

```sh
$ php artisan migrate
```

### Create manager

```sh
$ php artisan db:seed
```

### Setup

```sh
$ make setup
```

### Run

```sh
$ make run
```
