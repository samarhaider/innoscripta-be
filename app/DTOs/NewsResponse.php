<?php

namespace App\DTOs;

class NewsResponse
{
    public string $title;
    public string $description;
    public string $url;
    public string $image;
    public string $source;
    public ?string $publishedAt;

    public function __construct(string $title, string $description, string $url, string $image, string $source, ?string $publishedAt)
    {
        $this->title       = $title;
        $this->description = $description;
        $this->url         = $url;
        $this->image       = $image;
        $this->source      = $source;
        $this->publishedAt = $publishedAt;
    }

    public function toArray(): array
    {
        return [
            'title'        => $this->title,
            'description'  => $this->description,
            'url'          => $this->url,
            'image'        => $this->image,
            'source'       => $this->source,
            'published_at' => $this->publishedAt,
        ];
    }
}
