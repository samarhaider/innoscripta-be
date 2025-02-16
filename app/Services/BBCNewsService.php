<?php

namespace App\Services;

use App\Services\Contracts\NewsServiceInterface;
use App\Transformers\BBCNewsTransformer;
use Illuminate\Support\Facades\Http;

class BBCNewsService implements NewsServiceInterface
{
    protected string $apiUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiUrl = 'https://newsapi.org/v2/top-headlines';  // BBC API endpoint
        $this->apiKey = config('services.news.providers.bbc.api_key'); // Get API key from config
    }

    public function fetchNews(): array
    {
        $response = Http::get($this->apiUrl, [
            'country'   => 'gb',   // BBC News is UK-based
            'apiKey'    => $this->apiKey,
        ]);

        $articles = $response->json()['articles'] ?? [];

        return BBCNewsTransformer::transform($articles); // Use transformer for consistency
    }
}
