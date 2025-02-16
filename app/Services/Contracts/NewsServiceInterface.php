<?php

namespace App\Services\Contracts;

interface NewsServiceInterface
{
    public function fetchNews(): array;
}
