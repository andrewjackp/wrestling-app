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
  <x-card class="article-card">

    <picture class="article-card__media">
      <img
        class="article-card__image"
        src="{{ $article->image_url ?? 'https://peprojects.dev/images/landscape.jpg' }}"
        alt="{{ $article->article_title }}"
      >

    <div class="article-card__tag-overlay">
        <x-tag>News</x-tag>
    </div>
    
    </picture>



    <div class="article-card__content-wrap">
      <x-card.title class="article-card__title">
        <a class="link" href="{{ $href }}">{{ $article->article_title }}</a>
      </x-card.title>

      <div class="article-card__meta">
        <span class="article-card__author">
          {{ $article->author->name ?? 'Staff' }}
        </span>

        <x-tag class="tag--success">
          {{ $date }}
        </x-tag>
      </div>

      <p class="article-card__preview">
        {{ $article->content }}
      </p>

      <div class="article-card__actions">
        <x-button-link href="/article-detail/{{ $article->id }}">
          Read More
        </x-button-link>
      </div>
    </div>

  </x-card>
</li>
