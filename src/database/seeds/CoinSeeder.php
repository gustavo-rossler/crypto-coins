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
                'id' => 'bitcoin-cash',
                'symbol' => 'bch',
                'name' => 'Bitcoin Cash',
            ],
            [
                'id' => 'litecoin',
                'symbol' => 'ltc',
                'name' => 'Litecoin',
            ],
            [
                'id' => 'ethereum',
                'symbol' => 'eth',
                'name' => 'Ethereum',
            ],
            [
                'id' => 'dacxi',
                'symbol' => 'dacxi',
                'name' => 'Dacxi',
            ],
            [
                'id' => 'chainlink',
                'symbol' => 'link',
                'name' => 'Chainlink',
            ],
            [
                'id' => 'tether',
                'symbol' => 'usdt',
                'name' => 'Tether',
            ],
            [
                'id' => 'stellar',
                'symbol' => 'xlm',
                'name' => 'Stellar',
            ],
            [
                'id' => 'polkadot',
                'symbol' => 'dot',
                'name' => 'Polkadot',
            ],
            [
                'id' => 'cardano',
                'symbol' => 'ada',
                'name' => 'Cardano',
            ],
            [
                'id' => 'solana',
                'symbol' => 'sol',
                'name' => 'Solana',
            ],
            [
                'id' => 'avalanche-2',
                'symbol' => 'avax',
                'name' => 'Avalanche',
            ],
            [
                'id' => 'terra-luna',
                'symbol' => 'lunc',
                'name' => 'Terra Luna Classic',
            ],
            [
                'id' => 'matic-network',
                'symbol' => 'matic',
                'name' => 'Polygon',
            ],
            [
                'id' => 'usd-coin',
                'symbol' => 'usdc',
                'name' => 'USDC',
            ],
            [
                'id' => 'binancecoin',
                'symbol' => 'bnb',
                'name' => 'BNB',
            ],
            [
                'id' => 'ripple',
                'symbol' => 'xrp',
                'name' => 'XRP',
            ],
            [
                'id' => 'uniswap',
                'symbol' => 'uni',
                'name' => 'Uniswap',
            ],
            [
                'id' => 'maker',
                'symbol' => 'mkr',
                'name' => 'Maker',
            ],
            [
                'id' => 'basic-attention-token',
                'symbol' => 'bat',
                'name' => 'Basic Attention',
            ],
            [
                'id' => 'the-sandbox',
                'symbol' => 'sand',
                'name' => 'The Sandbox',
            ],
            [
                'id' => 'eos',
                'symbol' => 'eos',
                'name' => 'EOS',
            ],
        ];
        Coin::truncate();
        Coin::insert($data);
    }
}
