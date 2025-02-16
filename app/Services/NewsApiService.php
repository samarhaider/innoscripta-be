<?php

namespace App\Services;

use App\Models\NewsArticle;
use App\Services\Contracts\NewsServiceInterface;
use App\Transformers\NewsApiTransformer;
use Illuminate\Support\Facades\Http;

class NewsApiService implements NewsServiceInterface
{
    protected string $apiUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiUrl = 'https://newsapi.org/v2/top-headlines';
        $this->apiKey = config('services.news.providers.newsapi.api_key');
    }

    /**
     * Fetch news articles either from the database or the API.
     *
     * @param string $category
     * @param int $pageSize
     * @return array
     */
    public function fetchNews(): array
    {
        $response = Http::get($this->apiUrl, [
            'country'   => 'us',
            'apiKey'    => $this->apiKey,
        ]);
        $articles = $response->json()['articles'] ?? [];
        return NewsApiTransformer::transform($articles);
    }
}

