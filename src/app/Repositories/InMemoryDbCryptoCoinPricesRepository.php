<?php

namespace App\Repositories;

use App\CryptoCoin;
use App\CryptoCoinPrice;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class InMemoryDbCryptoCoinPricesRepository implements IDbCryptoCoinPricesRepository
{
    public function getMostRecentPrice(CryptoCoin $cryptoCoin): CryptoCoinPrice
    {
        $timestamp = 1729788058;
        return new CryptoCoinPrice([
            'crypto_coin_api_id' => $cryptoCoin->api_id,
            'timestamp' => $timestamp,
            'price' => 99.99,
            'datetime' => date('Y-m-d H:i:s', $timestamp),
        ]);
    }

    public function save(CryptoCoinPrice $cryptoCoinPrice): CryptoCoinPrice
    {
        return $cryptoCoinPrice;
    }

    /**
     * Get the most approximate price, from a prices list
     * @param array $prices
     * @param int $timestamp
     * @return array
     */
    private function getMostApproximatePrice(Collection $coinPrices, int $timestamp): CryptoCoinPrice
    {
        $timeDiff = $timestamp - $coinPrices[0]->timestamp;
        $result = $coinPrices[0];
        foreach ($coinPrices as $coinPrice) {
            # fix timestamp from API to seconds
            $priceFixedTimestamp = $coinPrice->timestamp;

            # calculate the time diff
            $newTimeDiff = $timestamp - $priceFixedTimestamp;

            # check if diff is < 1, has to be a positive value
            if ($newTimeDiff < 0) {
                $newTimeDiff *= -1;
            }

            # check the diff and updates if is less then current diff
            if ($newTimeDiff < $timeDiff) {
                $timeDiff = $newTimeDiff;
                $result = $coinPrice;
            }
        }

        return $result;
    }

    public function getPriceByDateTime(CryptoCoin $cryptoCoin, string $dateTime): CryptoCoinPrice
    {
        $timestamp = 1729788058;

        $requestedTimestamp = strtotime($dateTime);
        $tsHours = 60 * 60 * 2;
        $timestamp1 = $timestamp - $tsHours;
        $timestamp2 = $timestamp + $tsHours;

        $coinPrices = new Collection([
            new CryptoCoinPrice([
                'crypto_coin_api_id' => $cryptoCoin->api_id,
                'timestamp' => $timestamp1,
                'price' => 99.99,
                'datetime' => date('Y-m-d H:i:s', $timestamp1),
            ]),
            new CryptoCoinPrice([
                'crypto_coin_api_id' => $cryptoCoin->api_id,
                'timestamp' => $timestamp2,
                'price' => 0.435,
                'datetime' => date('Y-m-d H:i:s', $timestamp2),
            ]),
        ]);

        return $this->getMostApproximatePrice($coinPrices, $requestedTimestamp);
    }
}
