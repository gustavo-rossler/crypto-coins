<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Coin;

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
     * @return \App\Coin|null
     */
    public function getById(string $id): Coin;

    /**
     * Get a coin by its symbol
     * @param string $symbol
     * @return \App\Coin|null
     */
    public function getBySymbol(string $symbol): Coin;
}