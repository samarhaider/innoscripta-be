<?php

namespace App\Services;

use App\Models\NewsArticle;
use App\Services\Contracts\NewsServiceInterface;
use App\Transformers\NewYorkTimesTransformer;
use Illuminate\Support\Facades\Http;

class NewYorkTimesNewsService implements NewsServiceInterface
{
    protected string $apiUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiUrl = 'https://api.nytimes.com/svc/topstories/v2';
        $this->apiKey = config('services.news.providers.nyt.api_key');
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
        $response =  Http::get("{$this->apiUrl}/home.json", [
            'api-key' => $this->apiKey,
        ]);
        $articles = $response->json()['results'] ?? [];
        return NewYorkTimesTransformer::transform($articles);
    }

}
