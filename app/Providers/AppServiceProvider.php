<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // if (App::environment('production', 'local')) {
        //     URL::forceScheme('https');
        // }

        define('WELCOME_TITLE', config('content.welcome_title'));
        define('WELCOME_SUBJECT', config('content.welcome_subject'));
        define('LIGHTLINE_ADMIN', config('content.lightline_admin'));
        define('STATIC_CONTENT', config('content.static_content'));

        define('RESET_PASSWORD_TITLE', config('content.reset_password_title'));
        define('RESET_PASSWORD_SUBJECT', config('content.reset_password_subject'));
    }
}
