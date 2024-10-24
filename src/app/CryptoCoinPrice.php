<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CryptoCoinPrice extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'crypto_coin_api_id',
        'timestamp',
        'price',
        'datetime',
    ];
}
