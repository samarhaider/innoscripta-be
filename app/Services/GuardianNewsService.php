<?php

namespace App\Services;

use App\Models\NewsArticle;
use App\Transformers\GuardianNewsTransformer;
use Illuminate\Support\Facades\Http;
use App\Services\Contracts\NewsServiceInterface;

class GuardianNewsService implements NewsServiceInterface
{
    protected string $apiUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiUrl = 'https://content.guardianapis.com/search';
        $this->apiKey = config('services.news.providers.guardian.api_key');
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
            'api-key'  => $this->apiKey,
        ]);
        return GuardianNewsTransformer::transform($response->json()['response']['results'] ?? []);
    }

    /**
     * Store fetched news articles in the database.
     *
     * @param array $articles
     */
    private function storeNewsInDatabase(array $articles)
    {
        foreach ($articles as $article) {
            NewsArticle::updateOrCreate([
                'title' => $article['title'],
                'url' => $article['url'],
            ], [
                'description' => $article['description'],
                'image' => $article['urlToImage'],
                'published_at' => $article['publishedAt'],
                'provider' => 'guardian',
            ]);
        }
    }
}
