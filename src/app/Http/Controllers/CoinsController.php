<?php

namespace App\Http\Controllers;

use App\Repositories\ICoinsRepository;
use Illuminate\Http\Request;
use App\UseCases\GetAllCryptoCoinsUseCase;
use App\UseCases\GetCryptoCoinBySymbolUseCase;

class CoinsController extends Controller
{
    private $getAllCryptoCoinsUseCase;
    private $getCryptoCoinBySymbolUseCase;

    public function __construct(
        GetAllCryptoCoinsUseCase $getAllCryptoCoinsUseCase,
        GetCryptoCoinBySymbolUseCase $getCryptoCoinBySymbolUseCase
    ) {

        $this->getAllCryptoCoinsUseCase = $getAllCryptoCoinsUseCase;
        $this->getCryptoCoinBySymbolUseCase = $getCryptoCoinBySymbolUseCase;
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
        $request->validate([
            'coin' => 'required|exists:crypto_coins,symbol',
        ]);

        $symbol = $request->input('coin');
        $coin = $this->getCryptoCoinBySymbolUseCase->execute($symbol);

        return response()->json([
            'coin' => $coin,
        ]);
    }
}
