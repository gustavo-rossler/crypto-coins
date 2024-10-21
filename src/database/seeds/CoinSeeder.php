<?php

use App\Coin;
use Illuminate\Database\Seeder;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 'bitcoin',
                'symbol' => 'btc',
                'name' => 'Bitcoin',
            ],
            [
                'id' => '',
                'symbol' => '',
                'name' => '',
            ],
            [
                'id' => 'binance-peg-bitcoin-cash',
                'symbol' => 'bch',
                'name' => 'Binance-Peg Bitcoin Cash',
            ],
            [
                'id' => 'binance-peg-litecoin',
                'symbol' => 'ltc',
                'name' => 'Binance-Peg Litecoin',
            ],
            [
                'id' => 'bridged-binance-peg-ethereum-opbnb',
                'symbol' => 'eth',
                'name' => 'Bridged Binance-Peg Ethereum (opBNB)',
            ],
            [
                'id' => '',
                'symbol' => '',
                'name' => '',
            ],
        ];
        Coin::insert($data);
    }
}
