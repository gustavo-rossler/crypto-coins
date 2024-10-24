<?php

namespace App\Repositories;

use App\CryptoCoin;
use App\CryptoCoinPrice;

interface IDbCryptoCoinPricesRepository extends IApiCryptoCoinPricesRepository
{
    /**
     * Get coin's price by its ID for a given datetime
     * @param CryptoCoin $cryptoCoin
     * @param string $dateTime
     * @return CryptoCoinPrice
     */
    public function getPriceByDateTime(CryptoCoin $cryptoCoin, string $dateTime): CryptoCoinPrice;

    /**
     * Saves the CryptoCoinPrice object
     * @param CryptoCoinPrice $cryptoCoinPrice
     * @return CryptoCoinPrice
     */
    public function save(CryptoCoinPrice $cryptoCoinPrice): CryptoCoinPrice;
}
