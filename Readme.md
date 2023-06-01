# Project Portfolio Finizens 🐳 Docker + PHP 8.2 + MySQL + Nginx + Symfony 6.2

## Description 😀

This project is an API implemented using Docker, PHP 8.2, MySQL, Nginx, Symfony 6.2, and Doctrine as the ORM and PHPUnit for unit testing. 

This project adheres to the hexagonal architecture and embraces the principles of Domain-Driven Design (DDD). It also incorporates an implementation of the CQRS pattern using a Command Bus and a Query Bus.

Running Symfony 6.2 into Docker containers using docker-compose tool.

## Installation

1. Clone this repository.

2. Create the file `./.docker/.env.nginx.local` using `./.docker/.env.nginx` as template. The value of the variable `NGINX_BACKEND_DOMAIN` is the `server_name` used in NGINX.

4. Go inside folder `./docker` and run `docker compose up -d` to start containers.

5. Inside the `php` container, run `composer install` to install dependencies from `/var/www/symfony` folder.

6. Use the following value for the DATABASE_URL environment variable:

```
DATABASE_URL=mysql://app_user:helloworld@db:3306/app_db?serverVersion=8.0.33
```
7. Run database migrations inside php container: `php bin/console doctrine:migrations:migrate`

8. To run the tests for this project:  `./vendor/bin/phpunit tests`

You could change the name, user and password of the database in the `env` file at the root of the project.
