# royal-app-test-task

## Installation

Rolay Test App in laravel 10(latest) version.
Royal Test App requires [php](https://www.php.net/) v8.1+ and [composer](https://getcomposer.org/) to run.

## .env File Change
- Copy `.env.example` to `.env` file
- Add env variable  `API_BASE_URL="https://symfony-skeleton.q-tests.com/api/v2/"` at end of file.

## Install the dependencies and devDependencies and start the server.
Compile Assets

```sh
cd project_folder
npm install
npm run dev
```

Run Laravel 
```sh
cd project_folder
composer install
php artisan key:generate
php artisan optimize:clear
php artisan serve
```

## Login Details
email :- ahsoka.tano@q.agency
password :- Kryze4President

## Create Author using Command Line
```sh
php artisan app:new-author
```
It will prompt you some input fiels and Also provide a API `Access Token` to authenticate with API and create author.
