<x-layout>
    <inner-column>
        <ul>
            @foreach($promotion->wrestlers as $wrestlers)
            <li>
                <a href="/wrestler/{{$wrestlers->id}}">{{$wrestlers->name}}</a>
            </li>
            @endforeach
        </ul>

        <h2 class="loud-voice">Articles dealing with: {{$promotion->name}}</h2>

        <ul class="article-list">
            @foreach($promotion->articles as $article)
                <x-article-card :article="$article" />
            @endforeach
        </ul>
    </inner-column>
</x-layout>