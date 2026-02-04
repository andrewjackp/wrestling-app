<x-layout>
  <inner-column>
    <x-card class='article-card'>
      <h1 class="attention-voice">{{ $article->article_title }}</h1>
      <p class="soft-voice">{{ $article->content }}</p>
    </x-card>
  </inner-column>
</x-layout>