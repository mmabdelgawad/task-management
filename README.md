## Installation

* Clone the repository
* Run `docker-compose up -d` to start docker containers
* Run `docker exec -it petshop_app bash` to enter the app container
* Inside th app container you need to run 
```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
npm install
```

