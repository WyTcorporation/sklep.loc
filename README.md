php artisan migrate
php artisan migrate --path=app/Modules/Admin/User/Migrations
php artisan migrate --path=app/Modules/Admin/Role/Migrations
php artisan migrate --path=app/Modules/Admin/Menu/Migrations
php artisan migrate --path=app/Modules/Admin/News/Migrations
#Нужно дополнить в конце!
{
    php artisan db:seed --class=AddMenu
    php artisan db:seed --class=CreateAdminUser
    php artisan db:seed --class=PermissionsTableSeeder
    php artisan db:seed --class=AdminRolePermissions
}

php artisan migrate --path=app/Modules/Admin/Pages/Migrations
php artisan migrate --path=app/Modules/Admin/Product/Migrations
php artisan migrate

ukraine.com.ua

# www/.htaccess

<IfModule mod_rewrite.c>
RewriteEngine on
RewriteRule ^$ public/ [L]
RewriteRule ((?s).*) public/$1 [L]
</IfModule>

# www/public/.htaccess

<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^((?s).*)$ index.php?_url=/$1 [QSA,L]
</IfModule>

SSH
Перейдите в каталог с загруженным проектом, выполнив команду:
cd lockit.com.ua/shop
Обновите зависимости и все пакеты, выполнив команду:
PATH=/usr/local/php82/bin:/usr/local/bin:/bin:/usr/bin:/usr/local/sbin:/usr/sbin:/sbin composer install
Выполните команду:
/usr/local/php82/bin/php artisan migrate
Проверьте работу сайта.

/usr/local/php82/bin/php artisan optimize
/usr/local/php82/bin/php artisan cache:clear
/usr/local/php82/bin/php artisan route:cache
/usr/local/php82/bin/php artisan view:clear
/usr/local/php82/bin/php artisan config:cache

php artisan make:module Sky/Test --all

# 1. Створити Docker-мережу
docker-compose up -d --build

# 2. Вперше:
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate

# 3. Перевстановлення
docker-compose build --no-cache
docker-compose up -d
docker-compose exec app composer install

docker cp  re589466_sklep.sql sklep_mysql:/re589466_sklep.sql 

docker exec -i sklep_mysql sh -c 'exec mysql -u root -p"$MYSQL_ROOT_PASSWORD" laravel < re589466_sklep.sql'

docker exec -it nginx sklep_nginx -T | grep client_max_body_size
docker exec -it sklep_nginx nginx -s reload
