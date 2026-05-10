<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = ['Bali', 'Jakarta', 'Yogyakarta', 'Bandung'];
        $types = ['Villa', 'Apartment', 'House', 'Guest House'];

        foreach ($locations as $location) {
            for ($i = 0; $i < 15; $i++) {
                $basePrice = match($location) {
                    'Bali' => 500000,
                    'Jakarta' => 400000,
                    'Yogyakarta' => 200000,
                    'Bandung' => 300000,
                };
                
                // Randomize price +/- 30%
                $price = $basePrice * rand(70, 130) / 100;
                
                \App\Models\Listing::create([
                    'location' => $location,
                    'property_type' => $types[array_rand($types)],
                    'price' => round($price / 10000) * 10000, // Round to nearest 10k
                    'rating' => rand(35, 50) / 10, // 3.5 to 5.0
                ]);
            }
        }
    }
}
