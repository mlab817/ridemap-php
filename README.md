<p align="center">
    <a href="https://github.com/mlab817/ridemap-php.git" target="_blank">
        <img src="https://user-images.githubusercontent.com/29625844/176083891-c21475f9-430a-45f8-80ad-f097b4522f4d.png" width="400">
    </a>
</p>

## About RIDEMAP

Ridemap is a web + mobile application designed to monitor ridership demand
under the Public Utility Vehicle Service Contracting  (PUVSC) Program.

## Under the Hood

This web application was developed through [Laravel](https://laravel.com) -
a web application framework with expressive, elegant syntax built using PHP.

This main purpose of this app is to bridge the mobile
applications with the database. It has only two main pages:

1. Dashboard; and
2. Registration.

The dashboard and registration page uses [Inertia.js](https://inertiajs.com/) and [React](https://reactjs.org/).
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

Composer:

- "php": "^7.3|^8.0",
- "fruitcake/laravel-cors": "^2.0",
- "guzzlehttp/guzzle": "^7.0.1",
- "inertiajs/inertia-laravel": "^0.6.3",
- "laravel/framework": "^8.75",
- "laravel/sanctum": "^2.11",
- "laravel/tinker": "^2.5",
- "laravel/ui": "^3.4",
- "php-open-source-saver/jwt-auth": "^1.4"

NPM:

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

## Pre-deployment

Make sure to run `npm run prod` to compile the js and css assets. This will generate
the js and css files as `public/js/app.js` and `public/css/app.css` files, respectively.
Laravel will automatically map its assets to this location.

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

### Git Version Control

1. Clone the repository to the server using `git clone https://github.com/mlab817/ridemap-php.git`.
Replace the provided repository URL with your repo url.
2. Duplicate the `.env.example` and rename to `.env` using `cp .env.example .env`.
3. Update the configuration values similar to the above.
4. Run `composer install` and `npm install` to install the dependencies.
5. Run `npm run prod` to build the js and css assets.

Note: For the database, you can dump your local database and restore it
in the server database.

## Author

This web app is developed by [Mark Lester Bolotaolo](https://github.com/mlab817).
