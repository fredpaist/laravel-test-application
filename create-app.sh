#!/usr/bin/env bash

# Please be aware, use this app creation script only with vessel.
set -e

COMPOSE_FILE="docker-compose.yml"

WORKING_DIR="$(pwd)"

SCRIPT_PATH="$(dirname ${0})"
SCRIPT_PATH="$(cd ${SCRIPT_PATH} && pwd)"

PROJECT_ROOT="$(cd ${SCRIPT_PATH}/ && pwd)"
APP_ROOT="$(cd ${PROJECT_ROOT}/ && pwd)"

APP_PORT=${1}
MYSQL_PORT=${2}

# copy .env file if not exists
if [ ! -f "${APP_ROOT}/.env" ]; then
  cp "${APP_ROOT}/.env.example" "${APP_ROOT}/.env"
fi

function docker_prep {
    # export current user id
    USER_ID=$(id -u -r)
    USER_NAME=$(whoami)

    docker run -u $USER_ID --rm -it \
      -v $(pwd):/opt \
      -w /opt/ shippingdocker/php-composer:latest \
      composer require shipping-docker/vessel

    bash vessel init
}

docker_prep

hash docker-compose 2> /dev/null

if [ "${?}" -ne 0 ]; then
  echo "docker-compose command not found."

  exit 1
fi

service_container_exists() {
    local SERVICE="${1}"

    if [ -z "${1}" ]; then
        exit 1
    fi

    echo "$(cd ${PROJECT_ROOT} && docker-compose -f ${COMPOSE_FILE} ps ${SERVICE} 2> /dev/null | grep _${SERVICE}_ | awk '{ print $1 }')"
}

# check which port to use
if [ "$#" -eq  "0" ]; then
    echo "Using default ports 80 and 3060"
else
    if [ "$APP_PORT" ]; then
      echo "Appying app port $APP_PORT."
      echo "APP_PORT=$APP_PORT" >> ./.env
    fi

    if [ "$MYSQL_PORT" ]; then
      echo "Appying mysql port $MYSQL_PORT."
      echo "MYSQL_PORT=$MYSQL_PORT" >> ./.env
    fi
fi

# start vessel.
./vessel start

# Check if container exist.
APP_CONTAINER=$(service_container_exists app)

if [ -z "${APP_CONTAINER}" ]; then
    echo "No APP container"
    exit 1
fi


./vessel exec app php artisan key:generate

# Start vessel actions to deliver application easier.
./vessel exec app composer install --no-interaction --prefer-dist --optimize-autoloader
./vessel exec app php artisan migrate
./vessel exec app php artisan db:seed

# install node modules and build assets.
./vessel npm install
./vessel npm run production

echo "Running tests"
./vessel exec app ./vendor/bin/phpunit

# Fix file permissions
CURRENT_UID=$(id -u)
CURRENT_GID=$(id -g)
