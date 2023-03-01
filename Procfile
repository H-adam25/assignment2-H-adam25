web: vendor/bin/heroku-php-apache2 -F fpm_custom.conf public/

worker: php artisan queue:restart && php artisan queue:work redis