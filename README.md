## Initial setup

1.Clone the repo
2.Create .env file with DB params: cp .env.example .env
3.composer install
4.php artisan migrate
5.php artisan serve


## PHPUNIT tests

- Copy .env.example to .env.testing so that your testing environment has its own configuration
- Create a new database specifically for this testing environment, e.g. weather-testing
- Add this new database name to the DB_DATABASE variable inside .env.testing
DB_HOST=localhost
DB_DATABASE=weather-testing
DB_USERNAME=root
DB_PASSWORD=

- Run php artisan key:generate --env=testing
- Migrate the testing database: php artisan migrate --env=testing
- Run the test suite to confirm everything works: php artisan test
- Run php artisan schedule:work to start scheduled job(initial setup is to run every 6 hours but can be tested to run every minute) 
