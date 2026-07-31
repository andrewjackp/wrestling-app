<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_title',
        'slug',
        'excerpt',
        'content',
        'promotion_id',
        'author_id',
        'status',
        'published_at',
        'category',
        'featured',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured'     => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = static::generateUniqueSlug($article->article_title);
            }
            if (empty($article->published_at) && ($article->status ?? 'published') === 'published') {
                $article->published_at = now();
            }
        });
    }

    public static function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i++;
        }
        return $slug;
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
