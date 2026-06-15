<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Models\Wrestler;
use App\Models\Bout;
use App\Models\Promotion;
use App\Models\Event;
use App\Models\Result;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WrestlerController;

Route::get('/', function () {
    $selectedPromotions = selectedPromotions();

    $articlesQuery = Article::latest()->take(9);
    if (!empty($selectedPromotions)) {
        $articlesQuery->whereIn('promotion_id', $selectedPromotions);
    }

    $eventsQuery = Event::with('promotion')->orderBy('event_date', 'desc');
    if (!empty($selectedPromotions)) {
        $eventsQuery->whereIn('promotion_id', $selectedPromotions);
    }

    $resultsQuery = Result::with(['bout.promotion', 'winner'])
        ->whereHas('bout', function ($q) use ($selectedPromotions) {
            if (!empty($selectedPromotions)) {
                $q->whereIn('promotion_id', $selectedPromotions);
            }
        });

    return view('dashboard', [
        'selectedPromotions' => $selectedPromotions,
        'articles' => $articlesQuery->get(),
        'events'  => $eventsQuery->get(),
        'results' => $resultsQuery->latest()->take(10)->get(),
    ]);
});

Route::get('/articles', function() {
    $selectedPromotions = selectedPromotions();

    $query = Article::query();

    if (!empty($selectedPromotions)) {
        $query->whereIn('promotion_id', $selectedPromotions);
    }

    return view('articles', [
        'articles' => $query->get(),
    ]);
});

Route::get('/article-detail/{article}', function (Article $article) {
    return view('article-detail', [
        'article' => $article,
    ]);
})->name('articles.show');

Route::get('wrestlers', [WrestlerController::class, 'getWrestlers']);

Route::get('add/wrestler', [WrestlerController::class, 'loadAddWrestlerForm']);

Route::post('add/wrestler', [WrestlerController::class, 'addWrestler'])->name('addWrestler');

Route::get('wrestler/{wrestler}/edit', [WrestlerController::class, 'editWrestler'])->name('editWrestler');

Route::put('wrestlers/{wrestler}', [WrestlerController::class, 'updateWrestler']);

Route::get('/wrestler/{wrestler}', [WrestlerController::class, 'loadWrestler'])->name('wrestler.show');

Route::get('wrestler/{wrestler}/delete', [WrestlerController::class, 'deleteWrestler']);

Route::get('/results', function() {
    $selectedPromotions = selectedPromotions();

    $query = Result::with(['bout.promotion', 'winner']);

    if (!empty($selectedPromotions)) {
        $query->whereHas('bout', fn ($q) => $q->whereIn('promotion_id', $selectedPromotions));
    }

    return view('results', [
        'results' => $query->get(),
    ]);
});

Route::get('/bouts', function() {
    $selectedPromotions = selectedPromotions();

    $query = Bout::with(['wrestlers', 'promotion', 'event']);

    if (!empty($selectedPromotions)) {
        $query->whereIn('promotion_id', $selectedPromotions);
    }

    return view('bouts', [
        'bouts' => $query->get(),
    ]);
});

Route::get('/bout/{bout}', function (Bout $bout) {
    $bout->load(['promotion', 'wrestlers', 'result.winner', 'event']);

    return view('bout', [
        'bout' => $bout,
    ]);
})->name('bout.show');

Route::get('/event/{event}', function (Event $event) {
    $event->load(['promotion', 'bouts.result.winner', 'bouts.wrestlers']);

    return view('event', [
        'event' => $event,
    ]);
})->name('event.show');

Route::get('/promotions', function() {

    $promotions = Promotion::with('wrestlers')->get();

    return view('promotions', [
        "promotions" => $promotions
    ]);
});


Route::get('/promotion/{promotion}', function (Promotion $promotion) {
    $promotion->load(['wrestlers', 'events', 'articles', 'bouts.result.winner']);

    return view('promotion', [
        'promotion' => $promotion,
    ]);
})->name('promotion.show');

// Route::get('/promotion/{id}', function(Promotion $id) {
//     return view('promotion', [
//         "promotions" => $id
//     ]);
// });


Route::get('/post/create', [PostController::class, 'create']);
Route::post('/post', [PostController::class, 'store']);

Route::get('/dashboard', function () {
    $selectedPromotions = selectedPromotions();

    // filtered if promotions selected
    $articlesQuery = Article::latest()->take(9);

    if (!empty($selectedPromotions)) {
        $articlesQuery->whereIn('promotion_id', $selectedPromotions);
    }

    $articles = $articlesQuery->get();

    $eventsQuery = Event::with('promotion')->orderBy('event_date', 'desc');

    if (!empty($selectedPromotions)) {
        $eventsQuery->whereIn('promotion_id', $selectedPromotions);
    }

    $events = $eventsQuery->get();

    $resultsQuery = Result::with(['bout.promotion', 'winner'])
        ->whereHas('bout', function ($q) use ($selectedPromotions) {
            if (!empty($selectedPromotions)) {
                $q->whereIn('promotion_id', $selectedPromotions);
            }
        });

    $results = $resultsQuery->latest()->take(10)->get();

    return view('dashboard', [
        'selectedPromotions' => $selectedPromotions,
        'articles' => $articles,
        'events' => $events,
        'results' => $results,
    ]);
})->name('dashboard');