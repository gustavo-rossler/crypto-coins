<?php

namespace App\Repositories;

use App\CryptoCoinPrice;
use PhpParser\Error;

class CoinGeckoApiCryptoCoinPricesRepository implements ICryptoCoinPricesRepository
{
    public function getMostRecentPrice(string $id): CryptoCoinPrice
    {
        throw new Error(sprintf('No data found for %s', $id));
    }

    public function getPriceByDateTime(string $id, string $dateTime): CryptoCoinPrice
    {
        throw new Error(sprintf('No data found for %s at %s', $id, $dateTime));
    }
}