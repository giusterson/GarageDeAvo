composer install -n
php bin/console d:m:m --no-interaction
php bin/console doc:fix:load --no-interaction
php bin/console app:create-user demo@demo.com password
exec apache2-foreground