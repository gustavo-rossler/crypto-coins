<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Coin;
use PhpParser\Error;

class EloquentCoinsRepository implements ICoinsRepository
{
    public function getAll(): Collection
    {
        return Coin::all();
    }

    public function getById(string $id): Coin
    {
        $coin = Coin::find($id);
        if (!$coin) {
            throw new Error(sprintf('Coin with ID %s not found', $id));
        }
        return $coin;
    }

    public function getBySymbol(string $symbol): Coin
    {
        $coin = Coin::where('symbol', '=', $symbol)->first();
        if (!$coin) {
            throw new Error(sprintf('Coin with symbol %s not found', $symbol));
        }
        return $coin;
    }
}