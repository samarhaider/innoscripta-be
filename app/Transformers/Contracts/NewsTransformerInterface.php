<?php

namespace App\Transformers\Contracts;

interface NewsTransformerInterface
{
    public static function transform(array $articles): array;
}
