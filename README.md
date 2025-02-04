# proficiency-test

## Description
This is a proficiency test for a job application. List of technologies used:
- Backend: Laravel
- Database: PostgreSQL

## Requirements
- The application should have a RESTful API to manage the list of items.

## Installation Manual
1. Clone the repository
2. Run `cp .env.example .env`
3. Create a database in PostgreSQL and configure the `.env` file
4. Run `composer install`
5. Run `php artisan migrate:fresh --seed`
6. Run `php artisan key:generate`
7. Run `php artisan serve`
8. Access the application at `http://localhost:8000`

## Installation Docker-compose
1. Clone the repository
2. Run `docker compose up -d --build`
3. Run `docker exec app cp .env.example .env`
4. Run `docker exec app composer install`
5. Run `docker exec db psql -U postgres -c "CREATE DATABASE laravel;"` 
6. Run `docker exec app php artisan migrate:fresh --seed`
7. Run `docker exec app php artisan key:generate`
8. Access the application at `http://localhost:8000`

## Create user command
1. Run `docker exec -it app php artisan app:create-user {name} {email} {password}`
2. Confirm password
3. User created!

## API Documentation
- [<img src="https://run.pstmn.io/button.svg" alt="Run In Postman" style="width: 128px; height: 32px;">](https://app.getpostman.com/run-collection/26584214-ccf7fd85-3533-45a8-a49f-a6f3975310ae?action=collection%2Ffork&source=rip_markdown&collection-url=entityId%3D26584214-ccf7fd85-3533-45a8-a49f-a6f3975310ae%26entityType%3Dcollection%26workspaceId%3Dcbe95bc3-5ce3-4811-ab20-20d27f5b64ac#?env%5BNew%20Environment%5D=W3sia2V5IjoiaG9zdCIsInZhbHVlIjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FwaS92MSIsImVuYWJsZWQiOnRydWUsInR5cGUiOiJkZWZhdWx0Iiwic2Vzc2lvblZhbHVlIjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FwaS92MSIsInNlc3Npb25JbmRleCI6MH1d)
