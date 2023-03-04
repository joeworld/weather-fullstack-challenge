## Solution to the [Fullstack Challenge](https://github.com/bythepixel/fullstack-challenge)
The https://openweathermap.org/api v3.0 was used as the weather API.

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
  - Websockets: 
  - Visit api: `http://localhost`


## Things to consider:
- Chose your own weather api such as https://openweathermap.org/api or https://www.weather.gov/documentation/services-web-api.
- Testability.
- Best practices.
- Design patterns.
- Availability of external APIs is not guaranteed and should not cause page to crash.
- Twenty randomized users are added via the seeder process, each having their own unique location (longitude and latitude).
- Redis is available (Docker service) if you wish to use it.
- Queues, workers, websockets could be useful.
- Feel free to use a frontend UI library such as PrimeVue, Vuetify, Bootstrap, Tailwind, etc. 
- Anything else you want to do to show off your coding chops!

## To run the local dev environment:



### Frontend
- Navigate to `/frontend` folder
- Ensure nodejs v18 is active on host
- Install javascript dependencies: `npm install`
- Run frontend: `npm run dev`
- Visit frontend: `http://localhost:5173`
