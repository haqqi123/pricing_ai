<?php

namespace App\Services;

class PricingService
{
    public function calculate(array $market, string $date, float $rating = 4.5): array
    {
        $prices = array_column($market, 'price');
        $avg = array_sum($prices) / max(count($prices), 1);

        $dayOfWeek = date('N', strtotime($date));
        $isWeekend = $dayOfWeek >= 6;

        // Base adjustment
        $recommended = $isWeekend ? $avg * 1.10 : $avg * 0.95;

        // Rating adjustment
        if ($rating >= 4.7) {
            $recommended *= 1.03;
        } elseif ($rating <= 4.0) {
            $recommended *= 0.97;
        }

        return [
            'avg'         => round($avg),
            'recommended' => round($recommended),
            'condition'   => $isWeekend ? 'weekend' : 'weekday',
            'rating'      => $rating,
        ];
    }
}
