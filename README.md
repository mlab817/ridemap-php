<p align="center">
    <a href="https://github.com/mlab817/ridemap-php.git" target="_blank">
        <img src="https://user-images.githubusercontent.com/29625844/176156913-005515b4-dc2f-4997-a460-f36cd71829cb.png" width="400">
    </a>
</p>

# Content

- [About](#about)

- [Overview](#overview)
- [Requirements](#requirements)
- [Getting Started](#getting-started)
- [Folder Structures](#folder-structure)
- [Entity Relationship Diagram](#entity-relationship-diagram)
- [Pre-deployment](#pre-deployment)
- [Deployment](#deployment)
- [Mobile Apps](#mobile-apps)
- [Basic Troubleshooting](#basic-troubleshooting)
- [Author](#author)

## About

Ridemap is a web + mobile application designed to monitor ridership demand
under the Public Utility Vehicle Service Contracting  (PUVSC) Program.

## Overview

This web application was developed through [Laravel](https://laravel.com) -
a web application framework with expressive, elegant syntax built using PHP.

The main purpose of this app is to bridge the mobile
applications with the database. It has only two main pages:

1. Dashboard; and
2. Registration.

The dashboard and registration pages use [Inertia.js](https://inertiajs.com/) and [React](https://reactjs.org/).
The chart in the dashboard uses [React-Vis](https://uber.github.io/react-vis/).

On the other hand, it has the following API endpoints that
can be accessed by mobile apps mainly to handle device authentication
and submission of data:

| Method | Endpoint | Description                                |
|--------|----------|--------------------------------------------|
|Authentication
| POST   | /api/register | Handles registration of users via api      |
| GET    | /api/me | Retrieves user information when logged in  |
| POST   | /api/refresh | Refresh user token                         |
| POST   | /api/login | Login via email and password               |
| POST   | /api/device-auth | Login using device ID                      |
| Data Submission
| GET    | /api/stations | Returns list of stations                   |   
| POST   | /api/faces | Receives and saves data on faces detected  |
| POST   | /api/passenger-count | Receives and saves data on passenger count |
| POST   | /api/qrs | Receives and saves data on QR scanned      |
| POST   | /api/faces | Receives and saves data on faces detected  |

## Requirements

To update this app, you must have the following:

1. PHP 7.3 and up
2. Composer
3. Node, NPM and Yarn
4. MySQL
5. Github

It is recommended to use [Laragon](https://laragon.org) as the development environment for Laravel
as it already contains requirements 1-5. You can either install github as CLI or GUI using Github
Desktop.

Composer dependencies:

- "php": "^7.3|^8.0",
- "fruitcake/laravel-cors": "^2.0",
- "guzzlehttp/guzzle": "^7.0.1",
- "inertiajs/inertia-laravel": "^0.6.3",
- "laravel/framework": "^8.75",
- "laravel/sanctum": "^2.11",
- "laravel/tinker": "^2.5",
- "laravel/ui": "^3.4",
- "php-open-source-saver/jwt-auth": "^1.4"

You can install composer dependencies using the command which will install dependencies
based on the `composer.lock` file:

```console
composer install
```

If you wish to update dependencies versions, you may run the following instead:

```console
composer update
```

To install new dependencies, just run:

```console
composer require vendor/package
```

NPM dependencies:

- "@babel/preset-react": "^7.18.6",
- "@inertiajs/inertia": "^0.11.0",
- "@inertiajs/inertia-react": "^0.8.0",
- "babel-preset-react": "^6.24.1",
- "echarts": "^5.3.3",
- "laravel-echo": "^1.12.0",
- "pusher-js": "^7.1.1-beta",
- "react": "^18.2.0",
- "react-dom": "^18.2.0",
- "react-vis": "^1.11.7"

> Important: This app has been intentionally developed with Laravel `8.*` to ensure
compatibility with most servers as the latest version of Laravel no longer
supports PHP versions below 8.0.

## Getting Started

Once you have the requirements, follow the following to set up your development environment:

1. Clone the repository to your local machine with:

```console
git clone https://github.com/mlab817/ridemap-php.git {folderName}
```

2. Enter the project root folder with:

```console
cd ridemap-php
```

3. Run composer install:

```console
composer install
```

4. Duplicate and rename .env.example to .env

```console
cp .env.example .env
```

5. Generate the app key and jwt secret key

```console
php artisan key:generate
php artisan jwt:secret
```

These commands will update the APP_KEY, JWT_SECRET, and JWT_ALGO in the .env file.

6. Update the app configuration in the .env, particularly the db config.

```dotenv
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Make sure you create the database in mysql and assigned it a user and password.

7. Migrate the tables to the database

```console
php artisan migrate --seed
```

This command will insert an admin user and the list of stations.

8. Run the following command to watch for file changes in assets (JS and CSS):

```console
npm run watch
```

9. Start the server:

```console
php artisan serve
```

## Folder Structure

1. app - contains files specific to the app. This is where your models and controllers are contained
2. bootstrap - autogenerated files
3. config - contains all config information of the app. values are controlled by .env
4. database - contains migrations, factories, and seeders. This is where you manage your database tables
5. lang - contains translation-related information
6. node_modules - dev dependencies for npm used for generating js and css
7. public - contains generated assets, images, and entry point of app (index.php)
8. resources - contains js (raw), css (raw), and views (for blade files). this is where you edit UI related matters
9. routes - api and web routes are where your routes live. this manages which controller will respond to url requests
10. storage - this is where uploaded files are stored as well as logs
11. tests - this is where test files are stored
12. vendor - composer dependencies

## Entity Relationship Diagram

<img src="https://user-images.githubusercontent.com/29625844/176199658-a8867c79-e6fb-4903-b233-7a656d33de19.png" width="400" alt="ridemap erd">

## Pre-deployment

To compile the JS and CSS assets, run the following command:

```console
npm run prod
```

This will generate the js and css files as `public/js/app.js` and `public/css/app.css` 
files, respectively. Laravel will automatically map its assets to this location.

> Known issue: When your app fails to load css and js functionalities,
> this is usually because the js/css assets are served over insecure connection.
> This can be fixed by adding the following code in AppServiceProvider:

```php
public function register()
{
    // add the following code
    if ($this->app->environment(['production'])) {
        URL::forceScheme('https');
    }
}
```

> Known issue: The app may sometimes fail to display changes made in the assets. For example,
> user interface may not update even after running `npm run prod` and uploading the assets.
> This is usually caused by the browser loading assets from the memory/disk cache. To solve this,
> it is recommended to clear the browser cache. The alternative is to disable caching of assets
> but this could cause performance issues as assets will then be downloaded for every page refresh. 

## Deployment

This web application can be deployed on servers that support PHP version 7.3 and up.

### Direct Upload

1. Update the config variables `.env` file particularly the following:

```dotenv
# App configuration
APP_NAME=
APP_ENV=
APP_KEY=
APP_DEBUG=
APP_URL=

# Database credentials
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

2. Zip the folder.
3. Upload the folder to the server.
4. Unzip the file.
5. (Optional) Run `php artisan optimize` in the command line / terminal to cache the views, routes, and config
to speed up the app.

## Mobile Apps

Mobile apps are used to collect data for the ridership demand. There 
are four prototype versions of the app that needs to be tested and
enhanced based on the performance in the field as well as other
factors.

1. [Ridemap Counter](https://github.com/mlab817/ridemap-counter)
2. [Ridemap Face Scanner](https://github.com/mlab817/ridemap-face-scanner)
3. [Ridemap QR Scanner](https://github.com/mlab817/ridemap-qr)
4. [Ridemap Kiosk](https://github.com/mlab817/ridemap-kiosk)

Click on their respective link to learn more.

## Basic Troubleshooting

Below is a compilation of some tips and common errors encountered when using Laravel:

1. When in development environment, set APP_DEBUG=true in the .env. This will ensure
that error information are displayed.

2. It is common to encounter errors when installing dependencies using
Composer. Just make sure your PHP version meets the minimum requirement.
Avoid running `composer update` as this can cause conflicts in dependency versions.

4. `Error: Specified key was too long`. Edit the following in AppServiceProvider:

```php
public function boot()
{
    Schema::defaultStringLength(191);
}
```

3. `Missing Class` which can happen when files are deleted manually.
Run `composer dumpautoload` and search for usage for deleted files particularly 
use section of files.

4. `Route not found` which can sometimes be caused by routes being cached.
Run `php artisan route:clear`. You may also run `php artisan route:list` to view all
existing routes of the application.

## Author

This web app is developed by [Mark Lester Bolotaolo](https://github.com/mlab817).
