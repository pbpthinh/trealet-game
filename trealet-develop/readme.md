# Getting started

## Installation

Please check the official [Laravel](https://laravel.com/docs/7.x/installation#installation) installation guide 

And check the official [Node](https://https://nodejs.org/en/docs/) installation guide for server requirements before you start 

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Switch to the repo folder

    cd /trealet-project

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Edit env file :
-Run local : 

    APP_ENV=local

-Run production :

    APP_ENV=production

-Add your database : 

    DB_HOST="host database server"
    DB_DATABASE="database name"
    DB_USERNAME="database root user"
    DB_PASSWORD="password"

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Install all package nodejs (**Project need Compiling Assets (Mix)**)

    npm install

Run Mix

    npm run dev

or production run :

    npm run prod 

Now, Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000


(**Edit 03/11/2021 by dbh939**)

## Vanguard - Advanced PHP Login and User Management

- Website: https://vanguardapp.io
- Documentation: https://milos.support-hub.io
- Developed by [Milos Stojanovic](https://mstojanovic.net)