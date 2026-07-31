<x-layout>
  <inner-column>
    <div class="page-header">
      <h1 class="attention-voice">Articles</h1>
      @auth
        <a class="btn btn--secondary" href="{{ route('articles.create') }}">Write Article</a>
      @endauth
    </div>

    @if(session('success'))
      <p class="article-form__success">{{ session('success') }}</p>
    @endif

    <ul class='article-list'>
      @foreach($articles as $article)
        <x-article-card :article="$article" />
      @endforeach
    </ul>
  </inner-column>
</x-layout>
