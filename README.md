# Laravel Library

This project embodies a library for managing books, including functionalities for handling categories, books, and user interactions such as book borrowing (book instances).

It is developed with the following stack:

* PHP (7.4) + Laravel (8)
* Livewire: full-stack framework for Laravel
* HTML (Blade Templates) + CSS (TailwindCSS Framework)

## Installation

Clone the repository

    git clone https://github.com/2Fac3R/laravel-library.git

Switch to the repo folder

    cd laravel-library

Install all the dependencies using composer

    composer install

Rename ".env.example" to ".env" and add your database settings.
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=<your-database>
    DB_USERNAME=<your-username>
    DB_PASSWORD=<your-password>

Run the database migrations

    php artisan migrate

Run the database seeder, this will create 10 users, 10 categories, 30 books and 50 book instances.

    php artisan db:seed

Start the local development server

    php artisan serve

## Usage

Log in or create a new user

    http://127.0.0.1:8000/dashboard
    http://127.0.0.1:8000/register
    http://127.0.0.1:8000/login
    
You can access to the following resources routes

    http://127.0.0.1:8000/categories
    http://127.0.0.1:8000/books
    http://127.0.0.1:8000/bookinstances

Create a new Book

    http://127.0.0.1:8000/books/create

Get a book and its book instances

    http://127.0.0.1:8000/books/{id}

Edit a book
 
    http://127.0.0.1:8000/books/{id}/edit

All resources work similar, you can try using categories for example.

This way you get the requested category and all the books inside that category.

    http://127.0.0.1:8000/categories/{id}/
    http://127.0.0.1:8000/categories/{id}/edit

## Description

I decided to use the following dependencies:

* [Jetstream](https://jetstream.laravel.com/2.x/introduction.html) It's a beautifully designed application starter kit for Laravel.
* [Livewire](https://laravel-livewire.com/) It's a full-stack framework for Laravel that makes building dynamic interfaces simple, without leaving the comfort of Laravel.

You can see all dependencies in the "composer.json" file.

## Note
Upon reviewing the code, you'll notice distinct table designs being employed. This deliberate choice should be taken into account when running the app.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Any feedback is appreciated.
