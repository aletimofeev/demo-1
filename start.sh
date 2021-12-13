#!/bin/bash

docker-compose up
docker-compose exec -u app backend php bin/console messenger:consume async -vv
