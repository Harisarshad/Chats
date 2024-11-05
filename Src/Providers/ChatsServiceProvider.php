<?php

namespace Modules\Chats\Src\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class ChatsServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // Load module routes
        $this->loadRoutesFrom(base_path('modules/chats/src/routes/web.php'));
    $this->loadRoutesFrom(base_path('modules/chats/src/routes/api.php'));
    $this->loadViewsFrom(base_path('modules/chats/src/resources/views'), 'Chats');
    $this->loadMigrationsFrom(base_path('modules/chats/src/database/migrations'));
    $this->loadTranslationsFrom(base_path('modules/chats/src/resources/lang'), 'Chats');
    }

}
