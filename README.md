## Installation Steps

### 1. Clone the repository

Clone this repo

```bash
git clone 
```

### 2. Add the DB Credentials & APP_URL

Next make sure to create a new database and add your database credentials to your .env file:

```bash
cp .env.example .env
```

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


### 4. Generate key

Generate fresh key

```bash
php artisan generate:key
```


### 5. Migrate and generate dummy user

Serve application

```bash
php artisan migrate
```

```bash
php artisan db:seed --class="UserSeeder"
```

### 6. Run app

Serve application

```bash
php artisan serve --port=8001
```

Login using 
`email=john@user.com`
`password=password`

And we're all good to go!

Start up a local development server with `php artisan serve` And, visit [http://localhost:8001/login](http://localhost:8001/login).
