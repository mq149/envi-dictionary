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
            if ($this->usingMongodb()) {
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
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }

    private function usingMongodb(): bool
    {
        return config('database.default') == 'mongodb';
    }
}
