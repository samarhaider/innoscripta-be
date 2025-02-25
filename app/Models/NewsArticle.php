<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'url', 'image', 'provider', 'published_at'];


    public function scopeSearch($query, $search)
    {
        return $query->when($search != null, function($q) use($search){
            $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
        });
    }

    public function scopeProvider($query, $provider)
    {
        return $query->when($provider != null, function($q) use($provider){
            $q->where('provider', $provider);
        });
    }

    public function scopeCategory($query, $category)
    {
        return $query->when($category != null, function($q) use($category){
            $q->where('category', $category);
        });
    }
    
    public function scopePublishedAt($query, $startDate, $endDate)
    {
        $query->when($startDate != null, function($q) use($startDate) {
            $q->whereDate('published_at', '>=', $startDate);
        });
        return  $query->when($endDate != null, function($q) use($endDate) {
            $q->whereDate('published_at', '<=', $endDate);
        });
    }

}
