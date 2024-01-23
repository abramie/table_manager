

Installation : 
Git clone
npm install
sudo apt install php8.2-curl php8.2-bcmath php8.2-dom php8.2-sqlite3
composer update
composer require doctrine/dbal //Pour permettre d'update du sqlite
npm run build 
php artisan migrate
