<?php

namespace App\UseCases;

use App\Repositories\ICoinsRepository;

class GetAllCryptoCoinsUseCase
{
    private $cryptoCoinsRepository;

    public function __construct(ICoinsRepository $cryptoCoinsRepository) {
        $this->cryptoCoinsRepository = $cryptoCoinsRepository;
    }

    public function execute()
    {
        return $this->cryptoCoinsRepository->getAll();
    }
}