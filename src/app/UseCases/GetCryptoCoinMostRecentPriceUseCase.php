<?php

namespace App\UseCases;

use App\CryptoCoin;
use App\Repositories\IDbCryptoCoinPricesRepository;

class GetCryptoCoinMostRecentPriceUseCase
{
    private $cryptoCoinPricesRepository;

    public function __construct(
        IDbCryptoCoinPricesRepository $cryptoCoinPricesRepository
    ) {

        $this->cryptoCoinPricesRepository = $cryptoCoinPricesRepository;
    }

    public function execute(CryptoCoin $cryptoCoin)
    {
        return $this->cryptoCoinPricesRepository->getMostRecentPrice($cryptoCoin);
    }
}
