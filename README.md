# VerifiCongo Project

This is the VerifiCongo project built with Laravel, Livewire, Sail (Docker), and Filament for an admin panel.

## About

A Verified Community News Platform

## Requirements

- PHP 8.2.23
- Node v20.17.0
- Docker Desktop
- Composer
- Laravel ^11.9
- MySQL 

## Getting Started

Follow these instructions to set up and run the project on your local machine using Laravel Sail.

1. Clone the repository & Navigate to the project directory

    ```
    git clone https://github.com/TaylorLok/VerifiCongo.git
    cd VerifiCongo
    ```

2. Install Dependencies

    ```
    composer install
    ```

3. Set Up Environment Variables

    Copy the example .env file and set up your environment variables:
    
    ```
    cp .env.example .env
    ```

4. Generate the application key:

    ```
    php artisan key:generate
    ```

5. Set Up Docker with Sail

    Ensure Docker Desktop is running, then start the containers:

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
    ./vendor/bin/sail npm run dev
    ```

8. Access the Application

    Once everything is set up, you can access the application at:

    ```
    http://localhost
    ```

9. Access the Filament Admin Panel

    ```
    http://localhost/admin/login
    ```

10. Create an admin user

    ```
    ./vendor/bin/sail artisan make:filament-user
    ```

11. Common Commands

    Here are some common commands for managing the project:

    - Start Docker containers:
      ```
      ./vendor/bin/sail up -d
      ```
    
    - Stop Docker containers:
      ```
      ./vendor/bin/sail down
      ```
    
    - Run Artisan commands:
      ```
      ./vendor/bin/sail artisan <command>
      ```
    
    - Run Composer commands:
      ```
      ./vendor/bin/sail composer <command>
      ```
    
    - Run NPM commands:
      ```
      ./vendor/bin/sail npm <command>
      ```

12. Rebuilding the Docker Containers

    If you need to rebuild the Docker containers (for example, after changing the docker-compose.yml):

    ```
    ./vendor/bin/sail build --no-cache
    ```

13. Stopping the Application

    To stop the Docker containers:

    ```
    ./vendor/bin/sail down
    ```