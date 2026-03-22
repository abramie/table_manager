

Installation : 

Git clone


Pour node : 
- curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
- sudo apt-get install nodejs
npm install

sudo apt install php8.2-curl php8.2-bcmath php8.2-dom php8.2-sqlite3 (A mettre à jour avec la bonne version de php)
sudo a2enmod rewrite //Sinon ça marche pas ...


composer update

composer require doctrine/dbal //Pour permettre d'update du sqlite

npm run build 

asweb php artisan migrate:fresh --seed --seeder=InitialDataSeeder

Pour données de test : php artisan migrate:fresh --seed

php artisan storage:link (Pour permettre l'upload de fichiers et tous ça)

php artisan key:generate

Il faut créer le .env, ajouter un mdp admin (celui par default du compte admin) 


