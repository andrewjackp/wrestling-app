<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Article;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('article_title');
            $table->text('excerpt')->nullable()->after('content');
            $table->string('status')->default('published')->after('excerpt');
            $table->timestamp('published_at')->nullable()->after('status');
        });

        // Backfill slugs for existing articles
        Article::all()->each(function ($article) {
            $slug = Str::slug($article->article_title);
            $original = $slug;
            $i = 1;
            while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                $slug = $original . '-' . $i++;
            }
            $article->slug = $slug;
            $article->published_at = $article->created_at;
            $article->saveQuietly();
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['slug', 'excerpt', 'status', 'published_at']);
        });
    }
};
