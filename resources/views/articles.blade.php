<x-layout>
  <inner-column>
    <ul class='article-list'>
      @foreach($articles as $article)
        <x-article-card :article="$article" />
      @endforeach
    </ul>
  </inner-column>
</x-layout>

      
 