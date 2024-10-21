<?php

namespace App\Http\Controllers;

use App\Repositories\ICoinsRepository;
use Illuminate\Http\Request;

class CoinsController extends Controller
{
    private $coinsRepository;

    public function __construct(ICoinsRepository $coinsRepository) {
        $this->coinsRepository = $coinsRepository;
    }

    public function list()
    {
        $coins = $this->coinsRepository->getAll();
        return response()->json([
            'coins' => $coins,
        ]);
    }

    public function getMostRecentPrice()
    {
        return response([
            'data' => 99.9,
        ]);
    }
}
