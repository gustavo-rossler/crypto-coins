<?php

namespace App\UseCases;

use App\Repositories\ICoinsRepository;
use App\Repositories\IApiCryptoCoinPricesRepository;

class FetchDataFromApiUseCase
{
    private $cryptoCoinsRepository;
    private $cryptoCoinPricesRepository;

    public function __construct(
        ICoinsRepository $cryptoCoinsRepository,
        IApiCryptoCoinPricesRepository $cryptoCoinPricesRepository
    ) {

        $this->cryptoCoinsRepository = $cryptoCoinsRepository;
        $this->cryptoCoinPricesRepository = $cryptoCoinPricesRepository;
    }

    public function execute()
    {
        $data = [];
        $coins = $this->cryptoCoinsRepository->getAll();
        foreach ($coins as $coin) {
            $data[] = $this->cryptoCoinPricesRepository->getMostRecentPrice($coin);
        }

        return $data;
    }
}
