<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Wrestler;
use App\Models\Bout;
use App\Models\Promotion;
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

Route::get('/bouts', function() {

    $bouts = Bout::with('wrestlers')->get();
    
    return view('bouts', [
        "bouts" => $bouts
    ]);
});

Route::get('/bout/{bout}', function(Bout $bout) {

    $bout->load('promotion');

    return view('bout', [
      'bout' => $bout
    ]);

})->name('bout.show');

Route::get('/promotions', function() {

    $promotions = Promotion::with('wrestlers')->get();

    return view('promotions', [
        "promotions" => $promotions
    ]);
});

Route::get('/promotions/{promotion}',function (Promotion $promotion) {
    $promotion->load(['wrestlers', 'articles']);

    return view('promotion', [
        "promotion" => $promotion
    ]);
});

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

    //always load all promotions    
    $promotions = Promotion::orderBy('name')->get();

    // filtered if promotions selected
    $articlesQuery = Article::latest()->take(3);

    if (!empty($selectedPromotions)) {
        $articlesQuery->whereIn('promotion_id', $selectedPromotions);
    }

    $articles = $articlesQuery->get();

    //getting wrestlers if promotion is selected
    $wrestlersQuery = Wrestler::latest()->take(20);

    if (!empty($selectedPromotions)) {
        $wrestlersQuery->whereIn('promotion_id', $selectedPromotions);
    }

    $wrestlers = $wrestlersQuery->get();

    return view('dashboard', [
        'promotions' => $promotions,
        'selectedPromotions' => $selectedPromotions,
        'articles' => $articles,
        'wrestlers' => $wrestlers,
    ]);
})->name('dashboard');

