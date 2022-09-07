echo "
cd /var/www/html/ && composer install --ignore-platform-reqs

cd /var/www/html/ && php bin/console doctrine:migrations:migrate
" | docker-compose run --rm -T php bash