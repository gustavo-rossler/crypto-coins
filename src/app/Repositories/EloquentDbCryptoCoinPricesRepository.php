<?php

namespace App\Repositories;

use App\CryptoCoin;
use App\CryptoCoinPrice;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class EloquentDbCryptoCoinPricesRepository implements IDbCryptoCoinPricesRepository
{
    public function getMostRecentPrice(CryptoCoin $cryptoCoin): CryptoCoinPrice
    {
        $coinPrice = CryptoCoinPrice::where('crypto_coin_api_id', $cryptoCoin->api_id)
            ->orderBy('timestamp', 'desc')
            ->first();
        if (!$coinPrice) {
            throw new \Error(
                sprintf('No price found for %s', $cryptoCoin->symbol)
            );
        }
        return $coinPrice;
    }

    public function save(CryptoCoinPrice $cryptoCoinPrice): CryptoCoinPrice
    {
        $cryptoCoinPrice->save();
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
        $requestedTimestamp = strtotime($dateTime);
        # Calculate timestamp to hours (12)
        $tsHours = 60 * 60 * 12;
        # Get the timestamp for 12 hours before the requested one
        $timestampFrom = $requestedTimestamp - $tsHours;
        # Get the timestamp for 12 hours after the requested one
        $timestampTo = $requestedTimestamp + $tsHours;

        $coinPrices = CryptoCoinPrice::where('crypto_coin_api_id', $cryptoCoin->api_id)
            ->whereBetween('timestamp', [$timestampFrom, $timestampTo])
            ->get();
        if ($coinPrices->isEmpty()) {
            throw new ResourceNotFoundException(
                sprintf('No prices found for the given datetime %s', $dateTime),
                404
            );
        }
        return $this->getMostApproximatePrice($coinPrices, $requestedTimestamp);
    }
}
