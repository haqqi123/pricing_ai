<?php

namespace App\Services;

class MarketDataService
{
    public function getMarketPrices($location): array
    {
        $listings = \App\Models\Listing::where('location', 'like', '%' . $location . '%')->get(['price']);
        
        if ($listings->isEmpty()) {
            // Fallback if no data is found for the location
            return [
                ['price' => 300000],
                ['price' => 350000],
            ];
        }

        return $listings->toArray();
    }
}
