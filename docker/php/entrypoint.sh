#!/bin/sh

set -e

echo "⏳ Attente de la base de données..."

# attendre que MySQL soit prêt
until php -r "new PDO('mysql:host=db;port=3306;dbname=hackathon', 'hacka_user', 'password');" >/dev/null 2>&1; do
    sleep 2
done

echo "✅ Base de données prête"

# installer dépendances si besoin
composer install --no-interaction

# migrations
php bin/console doctrine:migrations:migrate --no-interaction || true

# fixtures
php bin/console doctrine:fixtures:load --no-interaction || true

echo "🚀 Démarrage de PHP-FPM"

exec php-fpm
