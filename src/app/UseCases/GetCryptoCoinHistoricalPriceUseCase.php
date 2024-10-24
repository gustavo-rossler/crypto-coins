<?php

namespace App\UseCases;

use App\CryptoCoin;
use App\Repositories\IDbCryptoCoinPricesRepository;

class GetCryptoCoinHistoricalPriceUseCase
{
    private $cryptoCoinPricesRepository;

    public function __construct(
        IDbCryptoCoinPricesRepository $cryptoCoinPricesRepository
    ) {

        $this->cryptoCoinPricesRepository = $cryptoCoinPricesRepository;
    }

    public function execute(CryptoCoin $cryptoCoin, string $dateTime)
    {
        return $this->cryptoCoinPricesRepository->getPriceByDateTime($cryptoCoin, $dateTime);
    }
}
