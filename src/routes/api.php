<?php

use App\Http\Controllers\CoinsController;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function() {
    return  'OK';
});

Route::get('/crypto-coins', [CoinsController::class, 'list']);
Route::get('/crypto-coin-price', [CoinsController::class, 'getMostRecentPrice']);
