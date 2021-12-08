#!/bin/bash

composer install

#jwt
php bin/console lexik:jwt:generate-keypair

php bin/console doctrine:create:database --env test
php bin/console doctrine:migrations:migrate
php bin/console doctrine:migrations:migrate --env test
php bin/console doctrine:fixtures:load --env=test




