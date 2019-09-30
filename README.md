
cp .env.example .env

Remplir le .env

Vérifier que vous êtes bien sur la branche develop sur la branche develop

composer install

php artisan migrate

php artisan key:generate

php artisan db:seed --class=VoyagerDatabaseSeeder

php artisan storage:link

Après avoir crée un user: php artisan voyager:admin your@email.com

