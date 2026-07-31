<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function create(): View
    {
        $promotions = Promotion::orderBy('name')->get();
        return view('post.create', compact('promotions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'article_title' => 'required|string|max:255',
            'excerpt'       => 'nullable|string|max:500',
            'content'       => 'required|string',
            'promotion_id'  => 'nullable|exists:promotions,id',
            'status'        => 'in:draft,published',
            'category'      => 'nullable|in:News,Review,Opinion,Results,Feature',
            'featured'      => 'boolean',
        ]);

        $validated['author_id'] = auth()->id();
        $validated['featured'] = $request->boolean('featured');

        $article = Article::create($validated);

        return redirect()->route('articles.show', $article)->with('success', 'Article published.');
    }

    public function edit(Article $article): View
    {
        $promotions = Promotion::orderBy('name')->get();
        return view('post.edit', compact('article', 'promotions'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'article_title' => 'required|string|max:255',
            'excerpt'       => 'nullable|string|max:500',
            'content'       => 'required|string',
            'promotion_id'  => 'nullable|exists:promotions,id',
            'status'        => 'in:draft,published',
            'category'      => 'nullable|in:News,Review,Opinion,Results,Feature',
            'featured'      => 'boolean',
        ]);

        $validated['featured'] = $request->boolean('featured');

        if ($article->status === 'draft' && ($validated['status'] ?? 'published') === 'published') {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('articles.show', $article)->with('success', 'Article updated.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();
        return redirect('/articles')->with('success', 'Article deleted.');
    }
}
