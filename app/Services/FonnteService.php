<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    protected $baseUrl = 'https://api.fonnte.com/send';
    protected $token;

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }

    public function sendMessage(string $to, string $message)
    {
        $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])
            ->asForm()
            ->post($this->baseUrl, [
                'target' => $to,
                'message' => $message,
            ]);

        return $response->json();
    }
}
