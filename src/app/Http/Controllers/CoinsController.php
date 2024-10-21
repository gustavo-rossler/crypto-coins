<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoinsController extends Controller
{
    public function getMostRecentPrice()
    {
        return response([
            'data' => 99.9,
        ]);
    }
}
