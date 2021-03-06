#!/bin/sh

## Symfony cconfiguration
php bin/console doctrine:database:create --if-not-exists --quiet --no-interaction
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate --verbose --no-interaction --allow-no-migration
if [ ${APP_ENV} != "prod" ] 
   then 
        php bin/console doctrine:schema:update --force --verbose --no-interaction
        php bin/console doctrine:fixtures:load --quiet --no-interaction --no-debug
 fi

php bin/console cache:clear
php bin/console cache:warmup

chmod -R 777 /var/www/var
chmod -R 777 /var/www/public


## server config
php-fpm &
nginx -g "daemon off;"
