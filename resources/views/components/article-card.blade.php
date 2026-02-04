@props([
  'article',
  'date',
  'href' => null,
])

@php
  $href = $href ?? '#';
  $date = $date ?? '01/01/2026';
@endphp

<li {{ $attributes->merge(['class' => 'article-list__item']) }}>
  <x-card {{ $attributes->merge(['class' => 'article-card']) }}>
    <x-card.header>
        <x-card.title class="article-card__title">
          <a class="link" href="{{ $href }}">{{ $article->article_title }}</a>
        </x-card.title>
    </x-card.header>

    <x-card.body class='article-card__body'>
      <p class="article-card__content">{{ $article->content }}</p>
    </x-card.body>

    <x-card.footer>
      <div class="article-card__footer-left">
        <x-button-link href="/article-detail/{{$article->id}}">Read More</x-button-link>
      </div>

      <div class="article-card__footer-right">
        <x-tag>News</x-tag>
        <x-tag class="tag--success">{{ $date }}</x-tag>
      </div>
    </x-card.footer>
  </x-card>
</li>
