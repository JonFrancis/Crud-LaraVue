# Crud-LaraVue
The project uses Laravel, Vue and mysql.

## Installations=

XAMPP;

for vue packages just run:

```sh
npm i
``` 

with terminal inside the vue folder named "front";

for Laravel packages first install composer, and then run: 

```sh
composer install
``` 

with terminal inside the laravel folder named "Laravel";

To start the database make sure your file ".env" inside the "Laravel" folder have a valid database such as follow:

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mysql
DB_USERNAME=root
DB_PASSWORD= 
```

and then Start at XAMPP console Apache and Mysql server, and run:

```sh
php artisan migrate
``` 

with terminal inside the laravel folder named "Laravel";

Now you are good to start both the servers;

To the laravel server run:

```sh
php artisan serve
``` 

with terminal inside the laravel folder named "Laravel";

To the laravel server run:

```sh
npm run serve
``` 

with terminal inside the laravel folder named "Laravel";

### Versions:

Laravel: 8.75

Php: 8.2.12

Vue: 5.0.8
