<?php

namespace App\Services;

class MarketDataService
{
    public function getMarketPrices($location): array
    {
        // Simulasi data listing sekitar
        return [
            ['price' => 300000],
            ['price' => 350000],
            ['price' => 280000],
            ['price' => 320000],
        ];
    }
}
