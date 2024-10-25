<?php

namespace App\Http\Controllers;

use App\Http\ResponseModels\CryptoCoinPriceResponse;
use App\Repositories\ICoinsRepository;
use App\UseCases\FetchDataFromApiUseCase;
use App\UseCases\GetCryptoCoinHistoricalPriceUseCase;
use App\UseCases\GetCryptoCoinMostRecentPriceUseCase;
use App\UseCases\SaveCoinPricesUseCase;
use Illuminate\Http\Request;
use App\UseCases\GetAllCryptoCoinsUseCase;
use App\UseCases\GetCryptoCoinBySymbolUseCase;

class CoinsController extends Controller
{
    private $getAllCryptoCoinsUseCase;
    private $getCryptoCoinBySymbolUseCase;
    private $getCryptoCoinMostRecentPriceUseCase;
    private $getCryptoCoinHistoricalPriceUseCase;
    private $fetchDataFromApiUseCase;
    private $saveCoinPricesUseCase;

    public function __construct(
        GetAllCryptoCoinsUseCase $getAllCryptoCoinsUseCase,
        GetCryptoCoinBySymbolUseCase $getCryptoCoinBySymbolUseCase,
        GetCryptoCoinMostRecentPriceUseCase $getCryptoCoinMostRecentPriceUseCase,
        GetCryptoCoinHistoricalPriceUseCase $getCryptoCoinHistoricalPriceUseCase,
        FetchDataFromApiUseCase $fetchDataFromApiUseCase,
        SaveCoinPricesUseCase $saveCoinPricesUseCase
    ) {

        $this->getAllCryptoCoinsUseCase = $getAllCryptoCoinsUseCase;
        $this->getCryptoCoinBySymbolUseCase = $getCryptoCoinBySymbolUseCase;
        $this->getCryptoCoinMostRecentPriceUseCase = $getCryptoCoinMostRecentPriceUseCase;
        $this->getCryptoCoinHistoricalPriceUseCase = $getCryptoCoinHistoricalPriceUseCase;
        $this->fetchDataFromApiUseCase = $fetchDataFromApiUseCase;
        $this->saveCoinPricesUseCase = $saveCoinPricesUseCase;
    }

    public function list()
    {
        $coins = $this->getAllCryptoCoinsUseCase->execute();
        return response()->json([
            'coins' => $coins,
        ]);
    }

    public function getMostRecentPrice(Request $request)
    {
        # validate request payload
        $request->validate([
            'coin' => 'required|exists:crypto_coins,symbol',
        ]);

        try {
            # get payload values
            $symbol = $request->input('coin');

            # get the coin object
            $coin = $this->getCryptoCoinBySymbolUseCase->execute($symbol);

            # get the coin price
            $coinPrice = $this->getCryptoCoinMostRecentPriceUseCase->execute($coin);

            # build the response object
            $coinPriceResponse = new CryptoCoinPriceResponse();
            $coinPriceResponse->fillData($coin, $coinPrice);

            return response()->json([
                'data' => $coinPriceResponse,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], $exception->getCode() >= 200 ? $exception->getCode() : 500);
        }
    }

    public function getHistoricalPrice(Request $request)
    {
        # validate request payload
        $request->validate([
            'coin' => 'required|exists:crypto_coins,symbol',
            'datetime' => 'required|date_format:Y-m-d H:i:s',
        ]);

        try {
            # get payload values
            $symbol = $request->input('coin');
            $dateTime = $request->input('datetime');

            # get the coin object
            $coin = $this->getCryptoCoinBySymbolUseCase->execute($symbol);

            # get the coin price
            $coinPrice = $this->getCryptoCoinHistoricalPriceUseCase->execute($coin, $dateTime);

            # build the response object
            $coinPriceResponse = new CryptoCoinPriceResponse();
            $coinPriceResponse->fillData($coin, $coinPrice);

            return response()->json([
                'data' => $coinPriceResponse,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], $exception->getCode() >= 200 ? $exception->getCode() : 500);
        }
    }

    public function syncPricesFromApi()
    {
        try {
            $data = $this->fetchDataFromApiUseCase->execute();
            $this->saveCoinPricesUseCase->execute($data);

            return response()->json([
                'message' => 'data synced!'
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], $exception->getCode() >= 200 ? $exception->getCode() : 500);
        }
    }
}
