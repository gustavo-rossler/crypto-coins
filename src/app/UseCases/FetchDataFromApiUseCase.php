<?php

namespace App\UseCases;

use App\Repositories\ICoinsRepository;
use App\Repositories\IApiCryptoCoinPricesRepository;

class FetchDataFromApiUseCase
{
    private $cryptoCoinsRepository;
    private $apiCryptoCoinPricesRepository;

    public function __construct(
        ICoinsRepository $cryptoCoinsRepository,
        IApiCryptoCoinPricesRepository $cryptoCoinPricesRepository
    ) {

        $this->cryptoCoinsRepository = $cryptoCoinsRepository;
        $this->apiCryptoCoinPricesRepository = $cryptoCoinPricesRepository;
    }

    public function execute()
    {
        $data = [];
        $coins = $this->cryptoCoinsRepository->getAll();
        foreach ($coins as $coin) {
            $data[] = $this->apiCryptoCoinPricesRepository->getMostRecentPrice($coin);
        }

        return $data;
    }
}
