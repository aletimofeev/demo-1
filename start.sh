#!/bin/bash

docker-compose exec -u app backend php bin/console messenger:consume async -vv
