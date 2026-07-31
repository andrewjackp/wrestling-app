<x-layout>
    <inner-column>

        <div class="promotion-detail__hero">
            @if($promotion->logo)
                <img class="promotion-detail__logo" src="{{ $promotion->logo }}" alt="{{ $promotion->name }}">
            @endif
            <h1 class="attention-voice">{{ $promotion->name }}</h1>
        </div>

        @if($promotion->championships->isNotEmpty())
            <section class="promotion-championships">
                <h2 class="loud-voice">Championships</h2>
                <ul class="championship-list">
                    @foreach($promotion->championships as $championship)
                        <li class="championship-list__item">
                            <span class="championship-list__name">{{ $championship->name }}</span>
                            @if($championship->holder)
                                <span class="soft-voice">
                                    Held by <a href="{{ route('wrestler.show', $championship->holder) }}">{{ $championship->holder->name }}</a>
                                    @if($championship->won_date)
                                        since {{ $championship->won_date->format('M j, Y') }}
                                    @endif
                                </span>
                            @else
                                <span class="soft-voice">Vacant</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        <section class="promotion-events">
            <h2 class="loud-voice">Events</h2>
            <ul>
                @forelse($promotion->events as $event)
                    <x-event-card :event="$event" />
                @empty
                    <p class="soft-voice">No events yet.</p>
                @endforelse
            </ul>
        </section>

        <section class="promotion-results">
            <h2 class="loud-voice">Results</h2>
            <ul class="result-list">
                @forelse($promotion->bouts->map->result->filter() as $result)
                    <x-result-card :result="$result" />
                @empty
                    <p class="soft-voice">No results yet.</p>
                @endforelse
            </ul>
        </section>

        <section class="promotion-articles">
            <h2 class="loud-voice">Articles</h2>
            <ul class="article-list">
                @forelse($promotion->articles as $article)
                    <x-article-card :article="$article" />
                @empty
                    <p class="soft-voice">No articles yet.</p>
                @endforelse
            </ul>
        </section>

        <section class="promotion-wrestlers">
            <h2 class="loud-voice">Roster</h2>
            <ul class="wrestler-list">
                @foreach($promotion->wrestlers as $wrestler)
                    <x-wrestler-card :wrestler="$wrestler" />
                @endforeach
            </ul>
        </section>

    </inner-column>
</x-layout>
