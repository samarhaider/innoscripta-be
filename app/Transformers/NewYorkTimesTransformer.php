<?php

namespace App\Transformers;

use App\Transformers\Contracts\NewsTransformerInterface;
use App\DTOs\NewsResponse;

class NewYorkTimesTransformer implements NewsTransformerInterface
{
    public static function transform(array $articles): array
    {
        return array_map(function ($article) {
            return new NewsResponse(
                title        : $article['title'],
                description  : $article['abstract'],
                url          : $article['url'],
                image        : $article['multimedia'][0]['url'] ?? "",
                source       : 'nyt',
                publishedAt  : $article['published_date'],
    
            );
        }, $articles);
    }
}
