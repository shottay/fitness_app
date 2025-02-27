# php_template
template for my php stack

# installieren

1. git clone
2. im project root: composer install
3. docker compose up -d --build
4. docker-compose exec app php artisan migrate
5. laravel installieren im project root: npm install && npm dev build


# useful commands

    ownership an USER geben für migrations

    sudo chown $USER:$USER 2025_02_23_153044_create_category_table.php

