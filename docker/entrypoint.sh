#!/bin/sh
set -eu

cd /var/www/html

mkdir -p var/cache var/log public/uploads
chown -R www-data:www-data var public/uploads

if [ "${APP_ENV:-prod}" = "prod" ]; then
  php bin/console assets:install public --env=prod
  php bin/console ckeditor:install --env=prod
  php bin/console cache:clear --no-warmup --env=prod
  php bin/console cache:warmup --env=prod
fi

if [ "${RUN_MIGRATIONS:-0}" = "1" ]; then
  php bin/console doctrine:migrations:migrate --no-interaction --all-or-nothing
fi

exec "$@"
