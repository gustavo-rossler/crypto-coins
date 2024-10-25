<?php

namespace App\Repositories;

use App\CryptoCoin;
use App\CryptoCoinPrice;

interface IApiCryptoCoinPricesRepository
{
    /**
     * Get most recent crypto coin's price by its ID
     * @param CryptoCoin $cryptoCoin
     * @return CryptoCoinPrice
     */
    public function getMostRecentPrice(CryptoCoin $cryptoCoin): ?CryptoCoinPrice;
}
