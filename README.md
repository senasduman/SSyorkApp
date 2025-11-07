## SsyorkApp — Laravel Music Project

This repository contains SsyorkApp, a Laravel-based music application. This README provides a detailed guide for development setup, configuration, database migrations, running the app, testing, deployment notes, troubleshooting, contribution guidelines, and a placeholder for a demo link.

---

## Table of Contents

-   Project Overview
-   Features
-   Technology Stack
-   Requirements
-   Local Setup (development)
-   Environment variables (example .env)
-   Database & migrations
-   Storage & file links
-   Running the application
-   Tests
-   Production build & deployment notes
-   Troubleshooting
-   Contributing
-   License
-   Demo

---

## Project Overview

SsyorkApp is a music web application built with Laravel. It models songs, albums, playlists and includes user interactions such as likes and playlist management. The codebase follows standard Laravel structure and conventions.

## Features

-   User registration and authentication
-   Models for Song, Album and Playlist
-   Add/remove songs from playlists
-   Playlist likes
-   Web and API routes (see `routes/web.php` and `routes/api.php`)

## Technology Stack

-   PHP (Laravel) — backend
-   Composer — dependency management
-   Node.js + npm — asset building (Vite, Tailwind)
-   MySQL / PostgreSQL / SQLite — database

## Requirements

-   PHP 8.1+ (verify compatibility with your installed Laravel version)
-   Composer
-   Node.js 16+ and npm or yarn
-   A relational database (MySQL/Postgres/SQLite)

## Local Setup (development)

Below are example commands for Windows PowerShell. Adjust paths/commands to match your OS if necessary.

1. Change to the project directory:

```powershell
cd "C:\Users\SsyorkApp"
```

2. Install PHP and Node dependencies:

```powershell
composer install --no-interaction --prefer-dist
npm install
```

3. Copy the example environment file:

```powershell
copy .env.example .env
```

4. Edit your `.env` with the correct database credentials and other environment-specific settings. See the sample below.

## Environment variables (sample .env)

Use this sample as a reference; do not commit secrets to version control.

```
APP_NAME=SsyorkApp
APP_ENV=local
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ssyork
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="SsyorkApp"
```

Generate an application key after setting up `.env`:

```powershell
php artisan key:generate
```

## Database & migrations

Run migrations to create the database schema:

```powershell
php artisan migrate
```

If seeders are provided and you want initial/sample data:

```powershell
php artisan db:seed
```

Tip: For a lightweight local DB you can use SQLite. Set `DB_CONNECTION=sqlite` and create an empty `database/database.sqlite` file.

## Storage & file links

Create the public storage symlink (Windows PowerShell):

```powershell
php artisan storage:link
```

On Linux/Unix production servers, ensure `storage` and `bootstrap/cache` are writable by the web server user.

## Running the application (development)

Start the Laravel development server and the asset watcher:

```powershell
php artisan serve
npm run dev
```

Open your browser at `http://127.0.0.1:8000` (or the address printed by `php artisan serve`).

## Tests

Run PHPUnit tests if available:

```powershell
vendor\bin\phpunit
```

Look in `tests/Feature` and `tests/Unit` for existing tests.

## Production build & deployment notes

1. Install production dependencies and build assets:

```powershell
composer install --optimize-autoloader --no-dev
npm install --production
npm run build
```

2. Cache configuration, routes and views for performance:

```powershell
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. Set correct file permissions for `storage` and `bootstrap/cache` on your server.

4. Use a process manager (Supervisor, systemd) for queue workers and schedule tasks (cron) for `php artisan schedule:run`.

## Troubleshooting

-   Error "Class 'X' not found": run `composer dump-autoload`.
-   Missing `APP_KEY`: run `php artisan key:generate` and update `.env`.
-   Database connection errors: verify DB\_\* values in `.env` and that your DB server is running.
-   File permission errors on Linux: adjust ownership, e.g. `chown -R www-data:www-data storage bootstrap/cache` (use appropriate user).

## Contributing

1. Fork the repository
2. Create a feature branch (e.g. `feature/your-feature`)
3. Make changes, add tests and run them
4. Open a pull request

Please follow code style, include tests for new features or bug fixes, and document notable changes.

## License


---

## Demo

Demo URL placeholder: [https://www.youtube.com/watch?v=bsYHjBq2RYw&t=247s]

---

Below are optional badges and a Laravel logo you can keep or remove as desired.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="360" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Resources

-   Official docs: https://laravel.com/docs
-   Laracasts: https://laracasts.com

If you want I can add screenshots, example API requests, or any project-specific instructions (for example, how to run a local media processing worker). Replace the demo placeholder with your live demo link when ready.
