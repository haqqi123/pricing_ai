<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function explain(array $pricing): string
    {
        $apiKey = env('OPENAI_API_KEY');

        // Fallback jika API key belum diset
        if (empty($apiKey) || str_starts_with($apiKey, 'sk-your')) {
            return $this->fallbackReason($pricing);
        }

        $prompt = $this->buildPrompt($pricing);

        try {
            $response = Http::timeout(15)->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type'  => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model'    => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role'    => 'system',
                        'content' => 'Kamu adalah analis pricing properti seperti Airbnb yang profesional.',
                    ],
                    [
                        'role'    => 'user',
                        'content' => $prompt,
                    ],
                ],
                'temperature' => 0.3,
                'max_tokens'  => 150,
            ]);

            if ($response->failed()) {
                return $this->fallbackReason($pricing);
            }

            return data_get($response->json(), 'choices.0.message.content', $this->fallbackReason($pricing));

        } catch (\Exception $e) {
            return $this->fallbackReason($pricing);
        }
    }

    private function fallbackReason(array $p): string
    {
        $diff = $p['recommended'] - $p['avg'];
        $pct  = round(abs($diff) / $p['avg'] * 100);
        $dir  = $diff >= 0 ? 'di atas' : 'di bawah';

        return "Harga Rp " . number_format($p['recommended'], 0, ',', '.') . " direkomendasikan {$pct}% {$dir} rata-rata pasar " .
               "karena kondisi {$p['condition']} mendorong penyesuaian demand. " .
               "Rating {$p['rating']} mencerminkan kualitas properti yang kompetitif di pasar.";
    }

    private function buildPrompt(array $p): string
    {
        return "Berikan alasan singkat (maksimal 2 kalimat) kenapa harga berikut direkomendasikan.

Data:
- Rata-rata harga pasar: Rp " . number_format($p['avg'], 0, ',', '.') . "
- Harga rekomendasi: Rp " . number_format($p['recommended'], 0, ',', '.') . "
- Kondisi: {$p['condition']}
- Rating properti: {$p['rating']}

Fokus pada faktor demand, kompetisi, dan kualitas properti. Gunakan bahasa Indonesia yang profesional.";
    }
}
