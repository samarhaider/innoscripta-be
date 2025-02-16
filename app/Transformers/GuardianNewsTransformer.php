<?php

namespace App\Transformers;

use Carbon\Carbon;

use App\DTOs\NewsResponse;
use App\Transformers\Contracts\NewsTransformerInterface;

class GuardianNewsTransformer implements NewsTransformerInterface
{
    public static function transform(array $articles): array
    {
        return array_map(function ($article) {
            return new NewsResponse(
                title       : $article['webTitle'] ?? 'No Title',
                description : "",
                url         : $article['webUrl'],
                image       : "",
                source      : 'guardian',
                publishedAt : Carbon::parse($article['webPublicationDate']),
            );
        }, $articles);
    }
}
