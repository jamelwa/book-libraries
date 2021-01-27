## Installation Steps

### 1. Clone the repository

Clone this repo

```bash
git clone 
```

### 2. Add the DB Credentials & APP_URL

Next make sure to create a new database and add your database credentials to your .env file:

```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

### 3. Run The Installer

To install the app

```bash
composer install --no-dev
```

And we're all good to go!

Start up a local development server with `php artisan serve` And, visit [http://localhost:8000/login](http://localhost:8000/login).
