

Installation : 

Git clone

npm install

sudo apt install php8.2-curl php8.2-bcmath php8.2-dom php8.2-sqlite3 (A mettre à jour avec la bonne version de php)

composer update

composer require doctrine/dbal //Pour permettre d'update du sqlite

npm run build 

php artisan migrate 

Pour données de test : php artisan migrate:fresh --seed

php artisan storage:link (Pour permettre l'upload de fichiers et tous ça)

php artisan key:generate

Il faut créer le .env, ajouter un mdp admin (celui par default du compte admin) 
