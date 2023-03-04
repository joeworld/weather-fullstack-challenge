## Solution to the [Fullstack Challenge](https://github.com/bythepixel/fullstack-challenge)
The https://openweathermap.org/api v3.0 was used as the weather API.

## I would appreciate it if the code reviewer would consider the following implementations that I have made:

### API
- Design pattern: To segregate the data access logic and align it with the business entities in the business logic, I employed the Repository design pattern.
- Caching: Redis was employed for caching, with a default Time-to-Live (TTL) of one hour. However, the TTL value can be customized by specifying a new value in the `.env` file using the `CACHE_TIME` parameter.
- Task Schedule: A task is scheduled to execute on an hourly basis, which updates the weather reports in the cache database.
- Tests: There are a total of eight functional tests and eleven unit tests. To run the feature tests, use the command `php artisan test --testsuite=Feature`. To run the unit tests, use the command `php artisan test --testsuite=Unit`.
- [Laravel Pint](https://laravel.com/docs/10.x/pint)  is used as code style fixer
- Laravel Websockets: A broadcast occurs when WeatherUpdated event is triggered
- My API service stands-alone inside `app/Services` directory
- Dependency Injections & Separation of concerns

### Frontend
- Pinea for store management
- TypeScript for type safety
- Tailwind CSS
- Vue composition API

## Setup

### API
- Navigate to `/api` folder
- Ensure version docker installed is active on host
- Copy .env.example: `cp .env.example .env`
- Start docker containers `docker compose up` (add `-d` to run detached)
- Connect to container to run commands: `docker exec -it fullstack-challenge-app-1 bash`
  - Make sure you are in the `/var/www/html` path
  - Install php dependencies: `composer install`
  - Setup app key: `php artisan key:generate`
  - Migrate database: `php artisan migrate` 
  - Seed database: `php artisan db:seed`
  - Run tests: `php artisan test`
  - Queue: `php artisan queue:listen --timeout` It's essential to execute this command as it monitors a job which is scheduled to fetch the most recent weather report every hour.
  - Laravel Websockets (Optional): `php artisan websockets:serve` and visit `http://localhost/laravel-websockets` then connect to port 6001
  - Visit api: `http://localhost`
  
### Frontend
  - Navigate to `/frontend` folder
  - Ensure nodejs v18 is active on host
  - Install javascript dependencies: `npm install`
  - Run frontend: `npm run dev`
  - Visit frontend: `http://localhost:5173`

##### Thank you and have a lovely day `:smiley:`