<?php

namespace App\Repositories;

use App\Models\NewsArticle;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\NewsListRequest;

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

    public function getNewsPaginate(NewsListRequest $request): LengthAwarePaginator
    {
        return NewsArticle::query()
            ->Search($request->get('search', null))
            ->Provider($request->get('provider', null))
            // ->Category($request->get('category', null))
            ->PublishedAt($request->get('date_start', null), $request->get('date_end', null))
            ->paginate();
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
