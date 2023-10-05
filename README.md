![cover](https://github.com/avocadomedia/hackathon/assets/32078923/22577f6c-8a5f-424f-9e3c-79c38846622d)

# Green rating platform

A simple app to rate locations based on their greenness, with a public API to retrieve the ratings so the government 
(or other instances) can use it to make decisions about where to improve.

## Installation

1. Clone the repository
2. Install dependencies using `composer install && npm install`
3. Copy `.env.example` to `.env`
4. Run `php artisan migrate:fresh --seed` to create the database and seed it with demo data (including admin user)
5. Run `npm run build` to build assets or `npm run dev` to watch for changes

## Features

- Admin panel to manage ratings (sign in at `/admin` with email `admin@admin.com` & password `admin`)
- Pins on the map that have been rated
- New rating form

## Tests

No tests at the moment due to the lack of time, but there should be.
