<?php

namespace App\Http\Controllers;

use App\Factories\NewsServiceFactory;
use Illuminate\Http\JsonResponse;

class NewsApiController extends Controller
{
    protected NewsServiceFactory $newsServiceFactory;

    public function __construct(NewsServiceFactory $newsServiceFactory)
    {
        $this->newsServiceFactory = $newsServiceFactory;
    }

    public function index(): JsonResponse
    {
        $newsService = $this->newsServiceFactory->create('newsapi');
        $news = $newsService->fetchNews('technology', 5);
        return response()->json($news);
    }
}
