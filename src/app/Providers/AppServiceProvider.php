<?php

namespace App\Providers;

use App\Repositories\CoinGeckoApiCryptoCoinPricesRepository;
use App\Repositories\EloquentCoinsRepository;
use App\Repositories\EloquentDbCryptoCoinPricesRepository;
use App\Repositories\ICoinsRepository;
use App\Repositories\IApiCryptoCoinPricesRepository;
use App\Repositories\IDbCryptoCoinPricesRepository;
use Illuminate\Support\ServiceProvider;
use App\UseCases\GetAllCryptoCoinsUseCase;
use App\UseCases\GetCryptoCoinBySymbolUseCase;

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
        $this->app->bind(IDbCryptoCoinPricesRepository::class, EloquentDbCryptoCoinPricesRepository::class);
        $this->app->bind(IApiCryptoCoinPricesRepository::class, CoinGeckoApiCryptoCoinPricesRepository::class);
        $this->app->bind(GetAllCryptoCoinsUseCase::class, GetAllCryptoCoinsUseCase::class);
        $this->app->bind(GetCryptoCoinBySymbolUseCase::class, GetCryptoCoinBySymbolUseCase::class);
    }
}
