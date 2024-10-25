<?php

namespace App\Repositories;

use App\CryptoCoin;
use App\CryptoCoinPrice;

class InMemoryApiCryptoCoinPricesRepository implements IApiCryptoCoinPricesRepository
{
    public function getMostRecentPrice(CryptoCoin $cryptoCoin): ?CryptoCoinPrice
    {
        $timestamp = 1729788058;
        if ($cryptoCoin->symbol !== 'btc') {
            return null;
        }
        return new CryptoCoinPrice([
            'crypto_coin_api_id' => 'btc',
            'timestamp' => $timestamp,
            'price' => 99.99,
            'datetime' => date('Y-m-d H:i:s', $timestamp),
        ]);
    }
}
