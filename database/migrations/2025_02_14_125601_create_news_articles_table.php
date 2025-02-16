<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('url');
            $table->string('category')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('published_at');
            $table->string('provider');  // News provider like 'newsapi', 'bbc', etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_articles');
    }
}
