Hello.

add

create a directory in your laravel project 'modules'.

add this chat repo in module folder..


add below line in your app/Provider/AppServiceProvider.php in boot function

$this->loadRoutesFrom(base_path('modules/Chats/Src/routes/web.php'));
$this->loadRoutesFrom(base_path('modules/Chats/Src/routes/api.php'));
$this->loadViewsFrom(base_path('modules/Chats/Src/resources/views'), 'Chats');
$this->loadMigrationsFrom(base_path('modules/Chats/Src/database/migrations'));
$this->loadTranslationsFrom(base_path('modules/Chats/Src/resources/lang'), 'Chats');


run migration  php artisan migrate --path=/modules/Chats/Src/Database/Migrations


hit the /chathome url

