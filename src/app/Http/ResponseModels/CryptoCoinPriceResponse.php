<?php

namespace App\Http\ResponseModels;

use App\CryptoCoin;
use App\CryptoCoinPrice;
use Illuminate\Database\Eloquent\Model;

class CryptoCoinPriceResponse extends Model
{
    protected $fillable = [
        'cryptoCoinName',
        'cryptoCoinSymbol',
        'price',
        'currency',
        'timestamp',
        'datetime',
        'timezone',
    ];

    public function fillData(CryptoCoin $cryptoCoin, CryptoCoinPrice $coinPrice)
    {
        $this->attributes = [
            'cryptoCoinName' => $cryptoCoin->name,
            'cryptoCoinSymbol' => $cryptoCoin->symbol,
            'price' => $coinPrice->price,
            'currency' => 'usd',
            'timestamp' => $coinPrice->timestamp,
            'datetime' => $coinPrice->datetime,
            'timezone' => 'UTC',
        ];
    }
}
