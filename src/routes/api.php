<?php

use App\Http\Controllers\CoinsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('/v1')->group(function() {
    Route::get('/', function () {
        return 'v1';
    });

    Route::prefix('/crypto-coins')->group(function () {
        Route::get('/', [CoinsController::class, 'list']);
        Route::get('/current-price', [CoinsController::class, 'getMostRecentPrice']);
        Route::get('/historical-price', [CoinsController::class, 'getHistoricalPrice']);
        Route::get('/sync-prices', [CoinsController::class, 'syncPricesFromApi']);
    });
});
