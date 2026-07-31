<x-layout>
  <inner-column>
    <article class="article-detail">

      <header class="article-detail__header">
        @if($article->promotion)
          <x-tag class="tag--success">{{ $article->promotion->name }}</x-tag>
        @endif

        <h1 class="attention-voice article-detail__title">{{ $article->article_title }}</h1>

        <div class="article-detail__meta">
          <span class="soft-voice">{{ $article->author->name ?? 'Staff' }}</span>
          @if($article->published_at)
            <x-tag>{{ $article->published_at->format('M j, Y') }}</x-tag>
          @endif
          @if($article->status === 'draft')
            <x-tag class="tag--danger">Draft</x-tag>
          @endif
        </div>

        @if($article->excerpt)
          <p class="article-detail__excerpt loud-voice">{{ $article->excerpt }}</p>
        @endif
      </header>

      <div class="article-detail__body">
        {!! nl2br(e($article->content)) !!}
      </div>

      <footer class="article-detail__footer">
        <a class="btn btn--secondary" href="/articles">← All Articles</a>
        @auth
          <a class="btn btn--secondary" href="{{ route('articles.edit', $article) }}">Edit</a>
        @endauth
      </footer>

    </article>
  </inner-column>
</x-layout>
