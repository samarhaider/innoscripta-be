<?php

namespace App\Repositories;

use App\Models\NewsArticle;
use Illuminate\Support\Collection;

class NewsRepository
{
    public function getNews(string $provider, string $category, int $limit): Collection
    {
        return NewsArticle::
            // where('provider', $provider)
            // ->where('category', $category)
            orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function storeNews(string $provider, array $articles): void
    {
        foreach ($articles as $article) {
            NewsArticle::updateOrCreate([
                'title' => $article->title,
                'url' => $article->url,
            ], [
                'description'  => $article->description,
                'image'        => $article->image,
                'published_at' => $article->publishedAt,
                'provider'     => $provider,
            ]);
        }
    }
}
