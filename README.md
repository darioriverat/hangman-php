# Hangman Game

You can download this project as follows.

```bash
git clone https://github.com/fermius/hangman-php.git
```

# Installation

This application was developed with Laravel 7x, most of the following steps are related to laravel
installation and configuration.

## Server requirements

As any Laravel application, you will need to make sure your server meets the following requirements.

- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

In addition, this game needs the following dependencies.

- MySQL >= 5.7

## Installing Laravel

Make sure you have composer installed in your machine and execute the following command to install the
dependencies.

```bash
composer install
```

## Configuration

Set up permission of `storeage` and `bootstrap/cache` directories.

```bash
chmod -R a+w storage
chmod a+w bootstrap/cache
```

Set up the environment variables copying the `.env.example` file.

```bash
cp .env.example .env
```

Make sure to set up at least the `DB_*` variables with the database information.
Finally, generate the key for the application.

```bash
php artisan key:generate
```

## Database

To create the database schema execute the following commands to run the migrations.

```bash
php artisan migrate
```

## Generating UI dependencies

To install UI dependencies and generate CSS and JS assets run the following command.

```bash
npm install && npm run dev
```

# Importing Words from Web

You can use the following command to import some words from the web.

```bash
php artisan import:words {quantity}
```

The words must be imported in alphabetical order (A-Z).
