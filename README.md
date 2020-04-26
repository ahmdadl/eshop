## EShop
an an e-commerce website build with laravel 7 and vuejs visit [link here](http://eshopt.rf.gd/)

## Features
* Multi-Language (en, ar)
* Developers Api
* Developers Console
* Daily Deals
* Add Product To Cart and Checkout
* Register and Verify Email
* Add new Products
* User Roles
  * Admin: can change user roles and Update, Delete any Product.
  * Super: can Update any Product.
  * Normal: can Create, Update and Delete only His Products.
* Rate-Review Product.
* Convert Price to 3 Currencies
* Share Product on Social Media

Prerequisites
* Laravel 7

## Installation


Clone the repository

    git clone https://github.com/abo3adel/eshop.git

Switch to the repo folder

    cd eshop

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Seed database with fake data
    
    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:gothinkster/laravel-realworld-example-app.git
    cd laravel-realworld-example-app
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    php artisan serve
---
#### Visit my Portfolio [Here](http://ninjacoder.rf.gd/)




