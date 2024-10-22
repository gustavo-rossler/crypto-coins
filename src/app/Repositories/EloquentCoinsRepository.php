<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\CryptoCoin;
use PhpParser\Error;

class EloquentCoinsRepository implements ICoinsRepository
{
    public function getAll(): Collection
    {
        return CryptoCoin::all();
    }

    public function getById(string $id): CryptoCoin
    {
        $coin = CryptoCoin::find($id);
        if (!$coin) {
            throw new Error(sprintf('Coin with ID %s not found', $id));
        }
        return $coin;
    }

    public function getBySymbol(string $symbol): CryptoCoin
    {
        $coin = CryptoCoin::where('symbol', '=', $symbol)->first();
        if (!$coin) {
            throw new Error(sprintf('Coin with symbol %s not found', $symbol));
        }
        return $coin;
    }
}