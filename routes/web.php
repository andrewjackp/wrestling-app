<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Wrestler;
use App\Models\Bout;
use App\Models\Promotion;
use App\Models\Event;
use App\Models\Result;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WrestlerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/articles', function() {
    return view('articles', [
        "articles" => Article::all()
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
    $results = Result::with(['bout', 'winner'])->get();

    return view('results', [
        'results' => $results,
    ]);
});

Route::get('/bouts', function() {

    $bouts = Bout::with(['wrestlers', 'promotion', 'event'])->get();
    
    return view('bouts', [
        "bouts" => $bouts
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

Route::get('/dashboard', function (Request $request) {
    $selectedPromotions = collect($request->input('promotions', []))
        ->filter()
        ->map(fn ($id) => (int) $id)
        ->values()
        ->all();

    // filtered if promotions selected
    $articlesQuery = Article::latest()->take(3);

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