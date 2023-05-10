# RandomJournal

The application allows users to register, login and make their own journal entries which will be shared anonymously with other users. Users who make an entry between 12pm the previous day and 24hrs from that time receive an email (emails are sent daily at 12pm) with journal entries from other users who shared an entry within the same timeframe. These users may also see the journal entries on the web app only if they meet the same criteria that applies for receiving the email.

The application is made using Laravel, Vue.js and Inertia (PHP and JavaScript). With Tailwind providing a lot of the CSS classes.

## Prerequisites

- Composer
- Node.js - v16.0.0 + (make sure to add the path to the nodejs application in your system environment variables so as to run the node command from anywhere when using the terminal)

## Project setup/Installation locally

- First, clone the project using `git clone https://github.com/brayo333/random-journal.git` on a terminal
- Next, change directory into the cloned project and run `composer install` in a terminal
- Create a `.env` file from `.env.example` by running `cp .env.example .env`
- Make the necessary configuration changes in the `.env` file
- Run `php artisan key:generate` to generate a key for your application (for encryption)
- Run `php artisan migrate` to create the database
- Run `npm install` to install Node dependancies (for Vue)

You will need two terminals running for the next two: 

- Run `php artisan serve` to run the server locally
- Run `npm run dev` to run the Vue pages (UI/frontend) locally
- View app locally on a browser on the link [http://127.0.0.1:8000/](http://127.0.0.1:8000/) or [http://localhost:8000/](http://localhost:8000/)

You can use another terminal:
- Run `php artisan schedule:work` to run the scheduler on the foreground ('manually') to test email sending functionality

## Project setup (production) pointers

- Remember to change the app environment to 'production' and make necessary changes in the `.env`
- Run `npm run build` to generate a production build for the frontend
- You can use `php artisan optimize` to cache server configurations and routes
- You can use `php artisan optimize:clear` to clear the cache

- Run `php artisan schedule:run` to run the scheduler on the background for (sending emails). You will need to create a cron on your server for the application. Read this [article](https://www.iankumu.com/blog/laravel-scheduler/).

## License

This package is an open-sourced software licensed under the [MIT license](LICENSE.txt).
