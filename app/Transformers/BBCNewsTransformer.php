<?php

namespace App\Transformers;

use App\DTOs\NewsResponse;
use App\Transformers\Contracts\NewsTransformerInterface;

class BBCNewsTransformer implements NewsTransformerInterface
{
    public static function transform(array $articles): array
    {
        return array_map(function ($article) {
            return new NewsResponse(
                title        : $article['title'],
                description  : $article['description'],
                url          : $article['url'],
                image        : $article['urlToImage'],
                source       : "bbc",
                publishedAt  : $article['publishedAt'],
            );
        }, $articles);
    }
}
