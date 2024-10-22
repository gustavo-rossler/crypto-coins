<?php

namespace App\UseCases;

use App\Repositories\ICoinsRepository;

class GetCryptoCoinBySymbolUseCase
{
    private $cryptoCoinsRepository;

    public function __construct(ICoinsRepository $cryptoCoinsRepository) {
        $this->cryptoCoinsRepository = $cryptoCoinsRepository;
    }

    public function execute(string $symbol)
    {
        return $this->cryptoCoinsRepository->getBySymbol($symbol);
    }
}