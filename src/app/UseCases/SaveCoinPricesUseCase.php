<?php

namespace App\UseCases;

use App\CryptoCoinPrice;
use App\Repositories\IDbCryptoCoinPricesRepository;

class SaveCoinPricesUseCase
{
    private $cryptoCoinPricesRepository;

    public function __construct(
        IDbCryptoCoinPricesRepository $cryptoCoinPricesRepository
    ) {

        $this->cryptoCoinPricesRepository = $cryptoCoinPricesRepository;
    }

    public function execute(array $data)
    {
        foreach ($data as $coinPrice) {
            $priceExists = CryptoCoinPrice::where('timestamp', $coinPrice->timestamp)->exists();
            if (!$priceExists) {
                $this->cryptoCoinPricesRepository->save($coinPrice);
            }
        }
        return true;
    }
}
