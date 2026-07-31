<x-layout>
  <inner-column>
    <div class="page-header">
      <h1 class="attention-voice">Search</h1>
    </div>

    <form method="GET" action="{{ route('search') }}" class="search-form" role="search">
      <div class="search-form__row">
        <input
          type="search"
          name="q"
          class="article-form__input search-form__input"
          placeholder="Search wrestlers, articles, events…"
          value="{{ $query }}"
          autofocus
          aria-label="Search"
        >
        <button type="submit" class="btn btn--secondary">Search</button>
      </div>
    </form>

    @if(strlen($query) >= 2)
      @php
        $total = $wrestlers->count() + $articles->count() + $events->count();
      @endphp

      <p class="search-summary soft-voice">
        {{ $total }} {{ $total === 1 ? 'result' : 'results' }} for &ldquo;{{ $query }}&rdquo;
      </p>

      @if($wrestlers->isNotEmpty())
        <section class="search-section">
          <h2 class="loud-voice search-section__heading">Wrestlers</h2>
          <ul class="search-result-list">
            @foreach($wrestlers as $wrestler)
              <li class="search-result">
                <a class="search-result__title link" href="{{ route('wrestler.show', $wrestler) }}">
                  {{ $wrestler->name }}
                </a>
                @if($wrestler->promotion)
                  <x-tag>{{ $wrestler->promotion->name }}</x-tag>
                @endif
              </li>
            @endforeach
          </ul>
        </section>
      @endif

      @if($articles->isNotEmpty())
        <section class="search-section">
          <h2 class="loud-voice search-section__heading">Articles</h2>
          <ul class="search-result-list">
            @foreach($articles as $article)
              <li class="search-result">
                <a class="search-result__title link" href="{{ route('articles.show', $article) }}">
                  {{ $article->article_title }}
                </a>
                <div class="search-result__meta">
                  @if($article->promotion)
                    <x-tag>{{ $article->promotion->name }}</x-tag>
                  @endif
                  @if($article->published_at)
                    <span class="soft-voice">{{ $article->published_at->format('M j, Y') }}</span>
                  @endif
                </div>
              </li>
            @endforeach
          </ul>
        </section>
      @endif

      @if($events->isNotEmpty())
        <section class="search-section">
          <h2 class="loud-voice search-section__heading">Events</h2>
          <ul class="search-result-list">
            @foreach($events as $event)
              <li class="search-result">
                <a class="search-result__title link" href="{{ route('event.show', $event) }}">
                  {{ $event->name }}
                </a>
                <div class="search-result__meta">
                  @if($event->promotion)
                    <x-tag>{{ $event->promotion->name }}</x-tag>
                  @endif
                  @if($event->event_date)
                    <span class="soft-voice">{{ \Carbon\Carbon::parse($event->event_date)->format('M j, Y') }}</span>
                  @endif
                </div>
              </li>
            @endforeach
          </ul>
        </section>
      @endif

      @if($total === 0)
        <p class="search-empty">No results found for &ldquo;{{ $query }}&rdquo;. Try a different term.</p>
      @endif

    @elseif(strlen($query) > 0)
      <p class="soft-voice">Enter at least 2 characters to search.</p>
    @endif

  </inner-column>
</x-layout>
