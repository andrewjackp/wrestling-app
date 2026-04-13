<x-layout>
    <inner-column>
        <h1 class="attention-voice">{{ $promotion->name }}</h1>

        <section class="promotion-events">
            <h2 class="loud-voice">Events</h2>
            <ul>
                @forelse($promotion->events as $event)
                    <x-event-card :event="$event" />
                @empty
                    <p>No events yet.</p>
                @endforelse
            </ul>
        </section>

        <section class="promotion-results">
            <h2 class="loud-voice">Results</h2>
            <ul class="result-list">
                @forelse($promotion->bouts->map->result->filter() as $result)
                    <x-result-card :result="$result" />
                @empty
                    <p>No results yet.</p>
                @endforelse
            </ul>
        </section>

        <section class="promotion-articles">
            <h2 class="loud-voice">Articles</h2>
            <ul class="article-list">
                @forelse($promotion->articles as $article)
                    <x-article-card :article="$article" />
                @empty
                    <p>No articles yet.</p>
                @endforelse
            </ul>
        </section>

        <section class="promotion-wrestlers">
            <h2 class="loud-voice">Wrestlers</h2>
            <ul>
                @foreach($promotion->wrestlers as $wrestler)
                    <li>
                        <a href="/wrestler/{{ $wrestler->id }}">{{ $wrestler->name }}</a>
                    </li>
                @endforeach
            </ul>
        </section>
    </inner-column>
</x-layout>