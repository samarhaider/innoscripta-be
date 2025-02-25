<?php

namespace App\Http\Controllers;

use App\Factories\NewsServiceFactory;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\NewsListRequest;
use App\Repositories\NewsRepository;


class NewsController extends Controller
{
    protected NewsRepository $newsRepository;

    public function __construct()
    {
        $this->newsRepository = new NewsRepository();
    }

    public function index(NewsListRequest $request): JsonResponse
    {
        $news = $this->newsRepository->getNewsPaginate($request);
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
