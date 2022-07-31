<!-- add scribe package for laravel api documentation -->
composer require --dev knuckleswtf/scribe

php artisan vendor:publish --tag=scribe-config

php artisan scribe:generate