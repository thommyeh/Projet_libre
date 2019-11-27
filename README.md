
cp .env.example .env

Remplir le .env

composer install

php artisan migrate

php artisan key:generate

php artisan db:seed --class=VoyagerDatabaseSeeder

php artisan storage:link



