<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketDataService;
use App\Services\PricingService;
use App\Services\AIService;

class PricingController extends Controller
{
    public function getPrice(Request $request)
    {
        $location = $request->input('location');
        $date     = $request->input('date', now()->toDateString());
        $rating   = $request->input('rating', 4.5);

        // 1) Ambil data pasar (mock)
        $market = app(MarketDataService::class)->getMarketPrices($location);

        // 2) Hitung harga
        $pricing = app(PricingService::class)->calculate($market, $date, $rating);

        // 3) Minta AI kasih reasoning
        $reason = app(AIService::class)->explain($pricing);

        return response()->json([
            'market_average'    => $pricing['avg'],
            'recommended_price' => $pricing['recommended'],
            'condition'         => $pricing['condition'],
            'rating'            => $pricing['rating'],
            'reason'            => $reason,
        ]);
    }
}
