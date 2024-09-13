# VerifiCongo Project

This is the VerifiCongo project built with Laravel, Livewire, Sail (Docker), and Filament for an admin panel.

# About

A Verified Community News Platform

# Requirements

PHP 8.2.23
Node v20.17.0
Docker dekstop
Composer
Laravel ^11.9
MySql 

# Getting Started
Follow these instructions to set up and run the project on your local machine using Laravel Sail.

1. Clone the repository & Navigate to the project directory

    ```
    git clone https://github.com/TaylorLok/VerifiCongo.git
    ```
    ```
    cd verificongo
    ```
2. Install Dependencies

    ```
    composer install
    ```
3. Set Up Environment Variables and Copy the example .env file and set up your environment variables
    
    ```
    cp .env.example .env
    ```
4. Generate the application key:

    ```
    php artisan key:generate
    ```
5. Set Up Docker with Sail
    If you are using Sail (Docker), you can set up your project containers. First, ensure Docker Desktop is running.
    Then, run the following command to start the containers:

    ```
    ./vendor/bin/sail up -d
    ```
    This will spin up the MySQL and Laravel containers. The application will be available at http://localhost.

6. Run Database Migrations

    ```
    ./vendor/bin/sail artisan migrate
    ```
7. Install NPM Dependencies and Compile Assets

    ```
    ./vendor/bin/sail npm install
    ```
    ```
    ./vendor/bin/sail npm run dev
    ```
8. Access the Application, Once everything is set up, you can access the application at:

    ```
    Copyhttp://localhost
    ```
9. Access the Filament Admin Panel

    ```
    Copyhttp://localhost/admin/login
    ```
10. Log in using the admin credentials you need to create user

    ```
    ./vendor/bin/sail artisan make:filament-user
    ```
11. Common Commands, here are some common commands for managing the project:
    Start Docker containers:

        ./vendor/bin/sail up -d
        
    Stop Docker containers:

        ./vendor/bin/sail down
        
    Run Artisan commands:

        ./vendor/bin/sail artisan <command>
      
    Run Composer commands:

        ./vendor/bin/sail composer <command>
        
    Run NPM commands:

    ./vendor/bin/sail npm <command>
    

12. Rebuilding the Docker Containers
    If you need to rebuild the Docker containers (for example, after changing the docker-compose.yml):

        
        ./vendor/bin/sail build --no-cache
        

13. Stopping the Application
    To stop the Docker containers:

        
        ./vendor/bin/sail down
        