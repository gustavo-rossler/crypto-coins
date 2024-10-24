<?php

namespace App\Repositories;

use App\CryptoCoin;
use App\CryptoCoinPrice;
use GuzzleHttp\Client;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class CoinGeckoApiCryptoCoinPricesRepository implements IApiCryptoCoinPricesRepository
{
    private function makeRequest(string $endpoint, array $params)
    {
        $baseUri = 'https://api.coingecko.com/api/v3';
        $client = new Client([
            'headers' => [
                'x-cg-demo-api-key' => getenv('COINGECKO_API_KEY'),
                'accept' => 'application/json',
            ],
        ]);
        $uri = sprintf('%s%s', $baseUri, $endpoint);
        $res = $client->request('GET', $uri, [
            'query' => $params,
        ]);

        if ($res->getStatusCode() !== 200) {
            throw new ResourceNotFoundException('Price not found', 404);
        }

        return $res->getBody();
    }

    public function getMostRecentPrice(CryptoCoin $cryptoCoin): CryptoCoinPrice
    {
        $endpoint = '/simple/price';
        $params = [
            'ids' => $cryptoCoin->api_id,
            'vs_currencies' => 'usd',
            'include_last_updated_at' => 'true',
        ];
        $response = $this->makeRequest($endpoint, $params);
        $data = json_decode($response, true);

        $priceData = $data[$cryptoCoin->api_id];

        return new CryptoCoinPrice([
            'crypto_coin_api_id' => $cryptoCoin->api_id,
            'timestamp' => $priceData['last_updated_at'],
            'price' => $priceData['usd'],
            'datetime' => date('Y-m-d H:i:s', $priceData['last_updated_at']),
        ]);
    }
}
