#Installation

Pour installer l'application, il suffit tout d'abord de recupérer le dernier dépot sur GitHub.
Ensuite, il faut lancer un composer install, qui s'occupera d'installer toutes les dépendances requises pour faire fonctionner le projet.

Ensuite, crée le dossier storage à la racine contenant : Framework, puis à l'intérieur de celui-ci : cache, sessions, views.

Modifier le fichier .env pour rajouter ses informations de base de données, ainsi que les paramètres de l'email. Et terminer par un php artisan key:generate.

Dernière commande à lancer : php artisan migrate et vous pouvez lancer le serveur ! :)