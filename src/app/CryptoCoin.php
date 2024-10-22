<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CryptoCoin extends Model
{
    protected $fillable = [
        'api_id',
        'name',
        'symbol',
    ];
}
