<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Wrestler;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function search(Request $request): View
    {
        $q = trim($request->input('q', ''));

        if (strlen($q) < 2) {
            return view('search', [
                'query'     => $q,
                'wrestlers' => collect(),
                'articles'  => collect(),
                'events'    => collect(),
            ]);
        }

        $wrestlers = Wrestler::with('promotion')
            ->where('name', 'like', "%{$q}%")
            ->orderBy('name')
            ->take(10)
            ->get();

        $articles = Article::with('promotion')
            ->where(function ($query) use ($q) {
                $query->where('article_title', 'like', "%{$q}%")
                      ->orWhere('content', 'like', "%{$q}%");
            })
            ->latest()
            ->take(10)
            ->get();

        $events = Event::with('promotion')
            ->where('name', 'like', "%{$q}%")
            ->orderBy('event_date', 'desc')
            ->take(10)
            ->get();

        return view('search', compact('q', 'wrestlers', 'articles', 'events'));
    }
}
