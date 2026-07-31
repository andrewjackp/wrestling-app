<x-layout>
  <inner-column>
    <div class="page-header">
      <h1 class="attention-voice">Articles</h1>
      @auth
        <a class="btn btn--secondary" href="{{ route('articles.create') }}">Write Article</a>
      @endauth
    </div>

    @if($filterPromotions->isNotEmpty())
      <div class="filter-bar">
        <span class="filter-bar__label soft-voice">Filtered by:</span>
        @foreach($filterPromotions as $p)
          <span class="filter-bar__item filter-bar__item--active">{{ $p->name }}</span>
        @endforeach
        <a class="filter-bar__clear" href="/articles">Clear</a>
      </div>
    @endif

    @if(session('success'))
      <p class="article-form__success">{{ session('success') }}</p>
    @endif

    <ul class='article-list'>
      @foreach($articles as $article)
        <x-article-card :article="$article" />
      @endforeach
    </ul>

    <div class="pagination-wrap">
      {{ $articles->links() }}
    </div>
  </inner-column>
</x-layout>
