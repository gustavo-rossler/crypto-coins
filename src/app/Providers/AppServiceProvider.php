<?php

namespace App\Providers;

use App\Repositories\EloquentCoinsRepository;
use App\Repositories\ICoinsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICoinsRepository::class, EloquentCoinsRepository::class);
    }
}
