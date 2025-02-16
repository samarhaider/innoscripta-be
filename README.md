# How to setup on local

### To running up locally

`docker compose up -d`

OR

`./vendor/bin/sail up -d  `

### Scraped news data from providers

`docker compose exec laravel.test php artisan news:scrap guardian`

OR

`./vendor/bin/sail php artisan news:scrap guardian`

##### providers list

-   nyt : New York Times
-   newsapi: News API org
-   guardian: Guardian

### How to add new provider

Steps:

1- Create a new service which implements `NewsServiceInterface`

2- Write its Transformer which convert provider response into NewsResponse DTOs

3- Add service in `config/services.php` file in array `news` add your provider in it with your service class.

That's all, you don't need to do anything, command is able to scrap data with new provider without hassle

Single api exposed for news (api/news?provider={provider})
Same we did for cron (php artisan news:scrap {provider})

### Authentication & Authorization

-   I use laravel sanctum package b/c for now we only need basic auth

### Improvement

-   Add pagination for news list
-   Remove old data
-   Send notification to admin on cron failed
-   Can use redis for repeated data caching
