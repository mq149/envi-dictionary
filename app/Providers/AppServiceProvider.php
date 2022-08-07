<?php

namespace App\Providers;

use App\Services\Implements\WordServiceMongodb;
use App\Services\Implements\WordServiceMysql;
use App\Services\Interfaces\WordServiceInterface;
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
        $this->app->bind(WordServiceInterface::class, function ($app) {
            if (is_using_mongodb()) {
                return $app->make(WordServiceMongodb::class);
            } else {
                return $app->make(WordServiceMysql::class);
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(in_debug_mode()) {
            URL::forceScheme('https');
        }
    }
}
