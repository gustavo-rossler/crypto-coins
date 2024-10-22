<?php

use App\CryptoCoin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Initial data with all coins that must be handled
        $data = [
            [
                'api_id' => 'bitcoin',
                'symbol' => 'btc',
                'name' => 'Bitcoin',
            ],
            [
                'api_id' => 'bitcoin-cash',
                'symbol' => 'bch',
                'name' => 'Bitcoin Cash',
            ],
            [
                'api_id' => 'litecoin',
                'symbol' => 'ltc',
                'name' => 'Litecoin',
            ],
            [
                'api_id' => 'ethereum',
                'symbol' => 'eth',
                'name' => 'Ethereum',
            ],
            [
                'api_id' => 'dacxi',
                'symbol' => 'dacxi',
                'name' => 'Dacxi',
            ],
            [
                'api_id' => 'chainlink',
                'symbol' => 'link',
                'name' => 'Chainlink',
            ],
            [
                'api_id' => 'tether',
                'symbol' => 'usdt',
                'name' => 'Tether',
            ],
            [
                'api_id' => 'stellar',
                'symbol' => 'xlm',
                'name' => 'Stellar',
            ],
            [
                'api_id' => 'polkadot',
                'symbol' => 'dot',
                'name' => 'Polkadot',
            ],
            [
                'api_id' => 'cardano',
                'symbol' => 'ada',
                'name' => 'Cardano',
            ],
            [
                'api_id' => 'solana',
                'symbol' => 'sol',
                'name' => 'Solana',
            ],
            [
                'api_id' => 'avalanche-2',
                'symbol' => 'avax',
                'name' => 'Avalanche',
            ],
            [
                'api_id' => 'terra-luna',
                'symbol' => 'lunc',
                'name' => 'Terra Luna Classic',
            ],
            [
                'api_id' => 'matic-network',
                'symbol' => 'matic',
                'name' => 'Polygon',
            ],
            [
                'api_id' => 'usd-coin',
                'symbol' => 'usdc',
                'name' => 'USDC',
            ],
            [
                'api_id' => 'binancecoin',
                'symbol' => 'bnb',
                'name' => 'BNB',
            ],
            [
                'api_id' => 'ripple',
                'symbol' => 'xrp',
                'name' => 'XRP',
            ],
            [
                'api_id' => 'uniswap',
                'symbol' => 'uni',
                'name' => 'Uniswap',
            ],
            [
                'api_id' => 'maker',
                'symbol' => 'mkr',
                'name' => 'Maker',
            ],
            [
                'api_id' => 'basic-attention-token',
                'symbol' => 'bat',
                'name' => 'Basic Attention',
            ],
            [
                'api_id' => 'the-sandbox',
                'symbol' => 'sand',
                'name' => 'The Sandbox',
            ],
            [
                'api_id' => 'eos',
                'symbol' => 'eos',
                'name' => 'EOS',
            ],
        ];

        # Disable FK constraints in order to truncate the table
        Schema::disableForeignKeyConstraints();
        # Truncate the table, this table's data will never change
        CryptoCoin::truncate();
        # Reenable FK constraints
        Schema::enableForeignKeyConstraints();

        # Insert the initial data
        CryptoCoin::insert($data);
    }
}
