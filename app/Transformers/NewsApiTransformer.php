<?php

namespace App\Transformers;

use Carbon\Carbon;

use App\Transformers\Contracts\NewsTransformerInterface;
use App\DTOs\NewsResponse;

class NewsApiTransformer implements NewsTransformerInterface
{
    public static function transform(array $articles): array
    {
        return array_map(function ($article) {
            return new NewsResponse(
                title       : $article['title'] ?? 'No Title',
                description : $article['description'] ?? 'No Description',
                url         : $article['url'] ?? '',
                image       : $article['urlToImage'] ?? '',
                source      : 'newsapi',
                publishedAt : Carbon::parse($article['publishedAt']) ?? null
            );
        }, $articles);
    }
}
