## Setup

- Clone repository
- Prepare a MySQL database (can be done quickly using Docker: https://hub.docker.com/_/mysql)
- If you intend to run tests, setup another database to run tests against
- Have PHP ^7.3|^8.0 with the required extensions for a basic Laravel project
- Install using Composer (https://getcomposer.org/)
- Create an environment file (`cp .env.example .env`) and fill in the database data. There is a testing environment file (.env.testing) in the repository
- Run migrations: `php artisan migrate`
- Run database seeders: `php artisan db:seed`
- Use a webserver or run `php artisan serve` to run the application
- Open `127.0.0.1:8000/api/questions/summary` (if using php artisan serve) for the summary of the answers to the survey
- Run tests: `php artisan test`
