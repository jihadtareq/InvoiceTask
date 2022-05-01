## Generates Invoices 

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework?query=laravel%208#v8.83.10"><img src="https://img.shields.io/packagist/v/laravel/framework" alt=" 8.83.10 Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## about project

- Admin can generates invoices for clients and create clients(done with unitTest).


## Requirements
- PHP 7.4.22.
- MySQL DB.
- StopLight API design.

## GitHub repo

for downlowd project copy this line:
git clone https://github.com/jihadtareq/InvoiceTask.git.

## Instructions
- Copy env.example in your env file.
- the following lines are commands you should run:
    - composer install.
    - php artisan migrate.
    - php artisan serve.
- to run queue jobs:
    - php artisan queue:work 
- to run unitTest command:
    - php artisan test
- open " invoice.json " in root  to get api design.
