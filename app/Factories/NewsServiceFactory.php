<?php

namespace App\Factories;

use Illuminate\Support\Facades\App;
use InvalidArgumentException;

class NewsServiceFactory
{
    /**
     * Create the appropriate news service based on the provider.
     *
     * @param string|null $provider
     * @return object
     * @throws InvalidArgumentException
     */
    public static function create(?string $provider = null): object
    {
        $provider = $provider ?? config('services.news.default_provider');

        // Get the service class name from the config
        $serviceClass = config("services.news.providers.$provider.class");

        if (!$serviceClass) {
            throw new InvalidArgumentException("Unsupported news provider: $provider");
        }

        // Dynamically resolve and return the service class
        return App::make($serviceClass);
    }
}
