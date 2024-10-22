<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\CryptoCoin;

interface ICoinsRepository
{
    /**
     * Get all coins
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Get a coin by its ID
     * @param string $id
     * @return \App\CryptoCoin|null
     */
    public function getById(string $id): CryptoCoin;

    /**
     * Get a coin by its symbol
     * @param string $symbol
     * @return \App\CryptoCoin|null
     */
    public function getBySymbol(string $symbol): CryptoCoin;
}