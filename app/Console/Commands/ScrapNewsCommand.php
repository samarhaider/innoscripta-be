<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Factories\NewsServiceFactory;
use App\Repositories\NewsRepository;

class ScrapNewsCommand extends Command
{
    protected $signature = 'news:scrap {provider}';
    protected $description = 'Scrap news articles from a specified provider and store them in the database.';

    public function handle(NewsRepository $newsRepository)
    {
        $provider = $this->argument('provider');

        // Validate provider
        if (!array_key_exists($provider, config('services.news.providers'))) {
            $this->error("Invalid news provider: {$provider}");
            return;
        }

        $newsService = NewsServiceFactory::create($provider); // Factory will load the service dynamically
        $articles = $newsService->fetchNews();

        // Store news in DB
        $newsRepository->storeNews($provider, $articles);
        $this->info(ucfirst($provider) . ' News scraped successfully.');
    }
}
