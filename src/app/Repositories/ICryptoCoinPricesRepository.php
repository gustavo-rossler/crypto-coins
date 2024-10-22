<?php

namespace App\Repositories;

use App\CryptoCoinPrice;

interface ICryptoCoinPricesRepository
{
    /**
     * Get most recent crypto coin's price by its ID
     * @param string $id
     * @return \App\CryptoCoinPrice
     */
    public function getMostRecentPrice(string $id): CryptoCoinPrice;

    /**
     * Get coin's price by its ID for a given datetime
     * @param string $id
     * @param string $dateTime
     * @return \App\CryptoCoinPrice
     */
    public function getPriceByDateTime(string $id, string $dateTime): CryptoCoinPrice;
}