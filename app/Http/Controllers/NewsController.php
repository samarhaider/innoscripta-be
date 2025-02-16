<?php

namespace App\Http\Controllers;

use App\Factories\NewsServiceFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\NewsRepository;


class NewsController extends Controller
{
    protected NewsRepository $newsRepository;

    public function __construct()
    {
        $this->newsRepository = new NewsRepository();
    }

    public function index(Request $request): JsonResponse
    {
        $provider = $request->query('provider', config('services.news.default_provider')); // Get provider from query or config
        $category = $request->query('category', config('services.news.default_category'));
        $pageSize = $request->query('size', 10);
        $news = $this->newsRepository->getNews($provider, $category, $pageSize);

        return response()->json($news);
    }

    // public function index(Request $request): JsonResponse
    // {
    //     $provider = $request->query('provider', config('services.news.default_provider')); // Get provider from query or config
    //     $newsService = NewsServiceFactory::create($provider); // Factory will load the service dynamically
    //     $news = $newsService->fetchNews();

    //     return response()->json(array_map(fn($newsItem) => $newsItem->toArray(), $news));
    // }
}
