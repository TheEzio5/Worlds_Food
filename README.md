# World of the Meals
This is multilingual application made with Laravel.<br>
Its purpose is to:
- validate & process request
- filter items(meals) using parameters from query
- return JSON response

## Installation (requires composer)
1. extract git repository
2. create new database in admin (phpmyadmin) and configure .env
3. locate to project root folder (world_of_meals) in command line and run commands:
-----------------
composer install
php artisan migrate
php artisan db:seed
php artisan serve
-----------------
Open in browser: http://localhost:8000/api/

make sure to include ?lang=

## Versions:
Composer: 2.4.<br>
Laravel: 8.83.27<br>
PHP: 8.2.2<br>
MySQL: 8.0.32-MariaDB
----------------------
By TheEzio5
----------------------
